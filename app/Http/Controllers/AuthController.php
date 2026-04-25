<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password'   => 'required|string',
        ]);

        if (RateLimiter::tooManyAttempts('login:' . $request->ip(), 5)) {
            return back()->withErrors([
                'identifier' => 'Terlalu banyak percobaan masuk. Silakan coba lagi dalam beberapa menit.',
            ]);
        }

        RateLimiter::hit('login:' . $request->ip(), 60);

        $identifier = $request->input('identifier');
        $field      = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $identifier, 'password' => $request->input('password')])) {
            RateLimiter::clear('login:' . $request->ip());
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'identifier' => 'Email/username atau password tidak valid.',
        ])->onlyInput('identifier');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
