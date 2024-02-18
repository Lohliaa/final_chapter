<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        $userRole = Auth::user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        return redirect('online-user/');
    }
}
