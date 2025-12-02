<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Allow only admins. Guests go to admin login; non-admin users go to shop.
     */
    public function handle(Request $request, Closure $next)
    {
        // If not logged in -> go to admin login (public)
        if (! auth()->check()) {
            return redirect()->route('admin.login');
        }

        // If logged in but not an admin -> send to shop (not to admin routes)
        if (! auth()->user()->isAdmin()) {
            return redirect()->route('shop.index');
        }

        // User is authenticated and is admin -> allow
        return $next($request);
    }
}
