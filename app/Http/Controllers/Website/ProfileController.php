<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        return $request->user();
    }

    public function updateProfile(Request $request)
    {
        $payload = $request->validate([
            'username' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
        ]);

        $member = $request->user();

        $member->fill($payload);
        $member->save();
    }

    public function getCurrentBalance(Request $request)
    {
        /** @var Member */
        $member = $request->user();
        return [
            'balance_display' => number_format($member->getCurrentBalance(), 2),
            'balance' => $member->getCurrentBalance(),
        ];
    }
}
