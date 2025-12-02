<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Prevent admins from entering user-only pages.
     * Redirect guests to login.
     */
    public function handle(Request $request, Closure $next)
    {
        // Guests -> let auth handle or redirect to login
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        // Admins -> redirect to admin dashboard (avoid letting them stay on user pages)
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
