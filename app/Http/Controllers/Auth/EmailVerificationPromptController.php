<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Instead of showing the verify-email prompt, show a simple success
        // message and redirect the user to the login chooser so they can pick
        // the appropriate login path after verifying.
        return redirect()->route('choose.login')->with('status', 'Please verify your email via the link we sent; after that you can choose how to log in.');
    }
}
