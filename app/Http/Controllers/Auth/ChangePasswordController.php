<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('auth.change-password');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $user = $request->user();
        $user->password = Hash::make($data['password']);
        $user->must_change_password = false;
        $user->save();

        // Re-login the user to refresh the session user instance so middleware
        // sees the updated `must_change_password` flag.
        Auth::login($user);

    $dashboard = $user->is_admin ? route('admin.dashboard') : route('dashboard');

    return redirect($dashboard)->with('status', 'Password changed successfully. Redirecting...');
    }
}
