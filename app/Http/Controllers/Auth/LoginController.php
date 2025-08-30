<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = auth()->user();
            
            // Log the login activity
            \App\Models\Activity::create([
                'user_id' => $user->id,
                'target_id' => $user->id,
                'type' => 'login',
                'description' => "{$user->name} logged in as " . ($user->is_admin ? 'admin' : 'user')
            ]);

            return redirect()->intended(
                $user->is_admin ? route('admin.dashboard') : route('dashboard')
            )->with('success', 'Welcome back, ' . $user->name);
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    /**
     * Redirect users based on their role (for other login methods).
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle admin login form POST.
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = true;
        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withErrors(['email' => 'Invalid admin credentials or not an admin.'])->withInput();
    }

    /**
     * Handle user login form POST.
     */
    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = false;
        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors(['email' => 'Invalid user credentials or not a regular user.'])->withInput();
    }
}