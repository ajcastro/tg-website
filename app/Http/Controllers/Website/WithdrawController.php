<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Member;
use App\Models\MemberBank;
use App\Models\MemberPromotion;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {
        $balance = $request->user()->getCurrentBalance();

        $request->validate([
            'recipient_bank_id' => ['required', 'exists:member_banks,id'],
            'account_name' => ['required'],
            'account_number' => ['required'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:'.$balance],
        ]);

        /** @var Member */
        $member = $request->user();
        /** @var MemberBank */
        $memberBank = $request->user()->banks()->find($request->recipient_bank_id);

        $transaction = MemberTransaction::make([
            'type' => 'withdraw',
            'is_adjustment' => 0,
            'account_code' => $memberBank->account_code,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'company_bank' => $request->recipient_bank,
            'company_bank_factor' => 0,
            'amount' => $request->amount,
            'remarks' => '',
            'member_ip' => $request->ip(),
            'member_info' => agent_member_info(),
        ]);

        $member->transactions()->save($transaction);
        $member->decrementBalanceAmount($transaction->amount);
    }
}
