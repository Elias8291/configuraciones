<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Regenerate session if authenticated
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Check if the username exists
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            // Return error for invalid username
            return back()->withErrors([
                'username' => trans('auth.user_failed'),
            ])->withInput();
        }

        // Return error for incorrect password
        return back()->withErrors([
            'password' => trans('auth.password'),
        ])->withInput();
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
