<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Member;
use App\Models\MemberPromotion;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {
        $request->validate([
            'recipient_bank' => ['required'],
            'account_name' => ['required'],
            'account_number' => ['required'],
            'amount' => ['required', 'numeric', 'gt:0'],
        ]);

        /** @var Member */
        $member = $request->user();

        $transaction = MemberTransaction::make([
            'type' => 'withdraw',
            'is_adjustment' => 0,
            'account_code' => $request->recipient_bank,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'company_bank' => $request->recipient_bank,
            'company_bank_factor' => 0,
            'amount' => $request->amount,
            'remarks' => '',
            'member_ip' => $request->ip(),
            'member_info' => null,
        ]);

        $member->transactions()->save($transaction);
    }
}
