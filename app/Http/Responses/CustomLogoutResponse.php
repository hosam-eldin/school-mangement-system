<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        // if admin logged in
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('status', 'Admin logged out!');
        }

        // if regular user logged in
        return redirect()->route('login')->with('status', 'You have been logged out!');
    }
}
