<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        $guard = $request->guard ?? 'web';
        // if admin logged in
        if ($guard === 'admin') {
            return redirect()->route('admin.login')->with('status', 'Admin logged out!');
        }

        // if regular user logged in
        return redirect()->route('login')->with('status', 'You have been logged out!');
    }
}