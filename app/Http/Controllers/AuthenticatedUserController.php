<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    public function AuthenticatedUserController()
    {
        return redirect()->route('dashboard');
    }

    public function darkmode(Request $request)
    {
        abort_unless($request->user(), 401);
        $request->user()->forceFill(['dark_mode' => ! $request->user()->dark_mode])->save();

        return back();
    }

    public function logOutUser(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function setpassword($email, $token)
    {
        return redirect()->route('password.reset', ['token' => $token, 'email' => $email]);
    }

    public function changePassword(Request $request)
    {
        return app(\App\Http\Controllers\Auth\NewPasswordController::class)->store($request);
    }

    public function forgetpassword(Request $request)
    {
        return app(\App\Http\Controllers\Auth\PasswordResetLinkController::class)->store($request);
    }
}
