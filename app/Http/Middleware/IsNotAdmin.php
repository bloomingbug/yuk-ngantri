<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Str;
use Illuminate\Http\Request;

class IsNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Str::lower((Auth::user()->role)) == 'admin') {
            abort(403);
        }

        return $next($request);
    }
}
