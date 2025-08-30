<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryPasswordMail;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Only allow password reset for Gmail addresses as requested
        $email = $request->input('email');
        $domain = strtolower(substr(strrchr($email, '@'), 1));
        if ($domain !== 'gmail.com') {
            throw ValidationException::withMessages([
                'email' => ['Password reset is allowed only for Gmail addresses (example: you@gmail.com).'],
            ]);
        }

        // Find the user
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            // To avoid leaking existence, behave as if mail was sent
            return back()->with('status', __('If the email exists, a temporary password has been sent.'));
        }

        // Generate a secure temporary password
        $tempPassword = bin2hex(random_bytes(6)); // 12 hex chars ~ 48 bits

        // Set the user's password to the temp password and mark must_change_password
        $user->password = Hash::make($tempPassword);
        $user->must_change_password = true;
        $user->save();

        // Send temporary password email
        try {
            Mail::to($user->email)->send(new TemporaryPasswordMail($tempPassword, $user));
        } catch (\Exception $e) {
            // Log the error but continue the flow to avoid revealing existence
            logger()->error('Temporary password email failed to send: ' . $e->getMessage());
        }

    // Do NOT log the user in. Require them to login with the temporary password.
    return redirect()->route('login')->with('status', __('Your password has been reset. Please log in with the temporary password sent to your email.'));
    }
}