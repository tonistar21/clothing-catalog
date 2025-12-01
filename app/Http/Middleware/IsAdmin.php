<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->is_admin != 1) {
            return redirect('/')->with('error', 'У вас немає доступу до цієї сторінки');
        }

        return $next($request);
    }
}
