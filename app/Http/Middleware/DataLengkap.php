<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class DataLengkap
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
        if (Auth::user()->role == 'mahasiswa' && (Auth::user()->kelas == null || Auth::user()->kelas == '')) {
            return redirect('/users'. '/' . Auth::user()->slug . '/edit')->with('lengkapi', 'Harap lengkapi profile anda terlebih dahulu');
        }

        return $next($request);
    }
}
