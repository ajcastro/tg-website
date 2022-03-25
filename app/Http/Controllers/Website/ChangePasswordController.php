<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (!Hash::check($value, $request->user()->password)) {
                        $fail('The old password is invalid.');
                    }
                },
            ],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $member = $request->user();

        $member->password = Hash::make($request->new_password);
        $member->save();
    }
}
