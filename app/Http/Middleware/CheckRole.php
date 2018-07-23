<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(\Auth::check()):
            if (!\Auth::user()->hasRole($role)):
                abort(404);
            endif;
        else:
            return redirect()->route('inicio');
        endif;
        
        return $next($request);
    }
}
