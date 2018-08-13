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
        $admin = Role::whereName('Administrador')->value('id');
        $coord = Role::whereName('Coordinador')->value('id');
        $alumn = Role::whereName('Alumno')->value('id');
        $docente = Role::whereName('Docente')->value('id');
        if($request->id == $admin || $request->id == $coord || $request->id == $alumn || $request->id == $docente){
            abort(404);
        }
        return $next($request);
    }
}
