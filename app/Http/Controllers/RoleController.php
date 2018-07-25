<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\role_has_permission;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function index()
    {
        $busqueda = Input::get('busqueda');
        $roles = Role::where('name','like',"%$busqueda%")->get();
        $permissions = Permission::all();
        $roles_has_permissions = role_has_permission::all();
        return view('roles.index',compact('roles','permissions','roles_has_permissions', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);

        if($request->has('crear')):
            $role->givePermissionTo('Crear');
        endif;

        if($request->has('ver')):
            $role->givePermissionTo('Ver');
        endif;

        if($request->has('Editar')):
            $role->givePermissionTo('Editar');
        endif;

        if($request->has('eliminar')):
            $role->givePermissionTo('Eliminar');
        endif;

        return redirect()->route('Roles')->with('status','El rol se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrfail($id);
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrfail($id);
        $role->syncPermissions();

        $role->name = $request->name;

        if($request->has('crear')) :
            $role->givePermissionTo('Crear');
        endif;

        if ($request->has('ver')) :
            $role->givePermissionTo('Ver');
        endif;

        if ($request->has('editar')) :
            $role->givePermissionTo('Editar');
        endif;

        if ($request->has('eliminar')) :
            $role->givePermissionTo('Eliminar');
        endif;

        $role->save();

        return redirect()->route('Roles')->with('status','El rol ha sido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role = Role::findOrfail($request->id);
        $role->delete();
        return redirect()->route('Roles')->with('status','El rol ha sido eliminado correctamente'); 
    }
}
