<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($permission,$request, Closure $next)
    {
        if (!\Auth::user()->hasPermission($permission)) :
            abort(404);
        endif;
        
        return $next($request);
    }
}
