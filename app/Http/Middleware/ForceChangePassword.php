<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceChangePassword
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->must_change_password) {
            // Allow access to the change password route so user can reset
            if (! $request->is('password/change') && ! $request->is('password/change/*')) {
                return redirect()->route('password.change');
            }
        }

        return $next($request);
    }
}
