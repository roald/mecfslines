<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( !Auth::check() ) {
            return redirect()->route('login');
        } elseif( Auth::user()->isAdmin() ) {
            return $next($request);
        }

        abort(403, 'Unauthorized action');
    }
}
