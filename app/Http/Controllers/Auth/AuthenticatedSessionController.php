<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            'role' => request()->query('role', 'user'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // If the user must change password, redirect them straight to the
        // password change screen so they can set a new password immediately.
        if (auth()->check() && auth()->user()->must_change_password) {
            return redirect()->route('password.change')->with('status', 'Please update your password.');
        }

        // Role-based redirect: prefer intended, otherwise use role-specific home
        $intended = redirect()->intended();

        $role = $request->input('login_as', 'user');

        // If there was an intended URL (from middleware), keep it
        if (session()->has('url.intended') && session('url.intended')) {
            return $intended;
        }

        // Otherwise send admins to admin dashboard, users to default HOME
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->to(RouteServiceProvider::HOME);
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