<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberBank;
use Illuminate\Http\Request;

class MemberBankController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->banks;
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'account_code' => ['required', 'exists:banks,code'],
            'account_number' => ['required'],
            'account_name' => ['required'],
        ]);

        /** @var Member */
        $member = $request->user();
        $memberBank = MemberBank::make($payload);
        $member->banks()->save($memberBank);

        return $memberBank;
    }
}
