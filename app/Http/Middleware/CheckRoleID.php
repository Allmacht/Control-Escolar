<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Role;


class CheckRoleID
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
        $role = Role::whereName('Administrador')->value('id');
        if($request->id == $role){
            abort(404);
        }
        return $next($request);
    }
}
