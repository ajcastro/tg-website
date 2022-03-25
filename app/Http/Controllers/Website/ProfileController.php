<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
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
            'email' => ['required'],
            'phone_number' => ['required'],
        ]);

        $member = $request->user();

        $member->fill($payload);
        $member->save();
    }
}
