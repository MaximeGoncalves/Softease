<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserForbidden
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasRole('ROLE_LEADER') || Auth::user()->hasRole('ROLE_USER')):
            Session::flash('error', 'Vous n\'avez pas les autorisations pour accéder à cette page');
            return redirect(route('home'))->with(301, 'Forbidden');
        endif;
        return $next($request);
    }
}
