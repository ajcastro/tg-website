<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CompanyBank;
use App\Models\Member;
use App\Models\MemberPromotion;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use App\Models\Website;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function deposit(Request $request)
    {
        $request->validate([
            'account_sender_id' => ['required'],
            'bank_destination_id' => ['required', 'exists:company_banks,id'],
            'total_deposit' => ['required', 'numeric', 'gt:0'],
            'description' => ['required'],
            'promotion_id' => ['nullable', 'exists:promotions,id'],
            'screenshot' => ['required', 'file'],
        ]);

        $websiteId = Website::getWebsiteId();
        /** @var Member */
        $member = $request->user();
        /** @var CompanyBank */
        $companyBank = CompanyBank::find($request->bank_destination_id);
        /** @var Promotion */
        $promotion = Promotion::find($request->promotion_id);
        /** @var MemberBank */
        $memberBank = $member->banks()->find($request->account_sender_id);

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
            'screenshot_name' => $request->file('screenshot')->getClientOriginalName(),
            'screenshot_path' => $request->file('screenshot')->store("website/{$websiteId}/images"),
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
        }
    }
}
