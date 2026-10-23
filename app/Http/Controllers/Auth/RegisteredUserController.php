<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'surname' => ['required', 'string', 'max:255'],
            'othernames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phoneno' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => ['required'],
        ]);

        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY');

        try {
            $responseData = \Illuminate\Support\Facades\Http::asForm()->connectTimeout(5)->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', ['secret' => $secretKey, 'response' => $recaptchaResponse]);
        } catch (\Throwable $e) {
            return back()->withErrors(['g-recaptcha-response' => 'Verification is temporarily unavailable. Please try again.'])->withInput($request->except('password', 'password_confirmation'));
        }

        if (! $responseData->successful() || ! $responseData->json('success')) {
            return back()->withErrors(['g-recaptcha-response' => 'Please complete the reCAPTCHA correctly'])->withInput($request->except('password', 'password_confirmation'));
        }

        $user = User::create([
            'surname' => $request->surname,
            'othernames' => $request->othernames,
            'phoneno' => $request->phoneno,
            'email' => $request->email,
            'user_type' => 'Client',
            'status' => 'Active',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('feedback', 'Registration Successful');
    }
}
