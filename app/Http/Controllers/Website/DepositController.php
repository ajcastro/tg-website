<?php

namespace App\Http\Controllers\Website;

use App\Enums\MemberTransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CompanyBank;
use App\Models\Member;
use App\Models\MemberBank;
use App\Models\MemberPromotion;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use App\Models\Website;
use App\Rules\Promotions\ValidatePromotionType;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function deposit(Request $request)
    {
        $websiteId = Website::getWebsiteId();
        /** @var Member */
        $member = $request->user();
        /** @var CompanyBank */
        $companyBank = CompanyBank::find($request->bank_destination_id);
        /** @var Promotion */
        $promotion = Promotion::with('setting')->find($request->promotion_id);
        /** @var MemberBank */
        $memberBank = $member->banks()->find($request->account_sender_id);

        $request->validate([
            'account_sender_id' => ['required'],
            'bank_destination_id' => ['required', 'exists:company_banks,id'],
            'total_deposit' => ['required', 'numeric', 'gt:0'],
            'description' => ['required'],
            'screenshot' => ['nullable', 'file'],
            'promotion_id' => [
                'nullable',
                'exists:promotions,id',
                $promotion ? new ValidatePromotionType($member, $promotion) : [],
            ],
        ]);

        $transaction = MemberTransaction::make([
            'type' => 'deposit',
            'is_adjustment' => 0,
            'account_code' => $memberBank->account_code,
            'account_name' => $memberBank->account_name,
            'account_number' => $memberBank->account_number,
            'company_bank' => $companyBank->bank_code,
            'company_bank_factor' => $companyBank->bank_factor,
            'amount' => $request->total_deposit,
            'remarks' => $request->description,
            'member_ip' => $request->ip(),
            'member_info' => agent_member_info(),
            'screenshot_name' => $request->hasFile('screenshot')
                ? $request->file('screenshot')->getClientOriginalName()
                : null,
            'screenshot_path' => $request->hasFile('screenshot')
                ? $request->file('screenshot')->store("website/{$websiteId}/images")
                : null,
        ]);

        $member->transactions()->save($transaction);

        if ($promotion) {
            $memberPromotion = MemberPromotion::make([
                'promotion_id' => $promotion->id,
                'deposit_date' => now(),
                'expire_date' => $promotion->setting->valid_thru,
                'deposit_amount' => $request->total_deposit,
                'bonus_amount' => $promotion->calculateBonusAmount($request->total_deposit),
                'obligation_amount' => $promotion->calculateObligationAmount($request->total_deposit),
                'turn_over_amount' => 0,
            ]);

            $member->memberPromotions()->save($memberPromotion);

            if ($promotion->isGivenOnDeposit() && $promotion->isAutoRelease()) {
                $this->autoCreditPromotionBonus($request, $member, $companyBank, $memberBank, $promotion, $memberPromotion);
            }
        }
    }

    private function autoCreditPromotionBonus(
        Request $request,
        Member $member,
        CompanyBank $companyBank,
        MemberBank $memberBank,
        Promotion $promotion,
        MemberPromotion $memberPromotion
    ) {
        if (!$promotion->isAutoRelease()) {
            return;
        }

        $transaction = MemberTransaction::make([
            'type' => 'deposit',
            'is_adjustment' => 0,
            'account_code' => $memberBank->account_code,
            'account_name' => $memberBank->account_name,
            'account_number' => $memberBank->account_number,
            'company_bank' => $companyBank->bank_code,
            'company_bank_factor' => $companyBank->bank_factor,
            'amount' => $memberPromotion->bonus_amount,
            'remarks' => '',
            'member_ip' => $request->ip(),
            'member_info' => agent_member_info(),
            'status' => MemberTransactionStatus::APPROVED,
        ]);

        $member->transactions()->save($transaction);
        $member->incrementBalanceAmount($memberPromotion->bonus_amount);
    }
}
