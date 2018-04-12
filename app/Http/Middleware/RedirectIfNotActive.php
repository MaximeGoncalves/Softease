<?php

namespace App\Http\Middleware;

use App\login;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfNotActive
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
        if (!empty(Auth::user() && Auth::user()->isActive(Auth::user()) == false)):
            return redirect('/logout');
        elseif (Auth::user()->isActive(Auth::user()) == false):
                Session::flash('error', 'Votre compte n\'est pas activé, merci de contacter votre reponsable.');
                return redirect('/login');

        endif;
        return $next($request);
    }
}
