<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->id != \Auth::user()->id):
            abort(404);  
        endif;

        return $next($request);
    }
}
