<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized: Admins only.');
        }

        return $next($request);
    }
}