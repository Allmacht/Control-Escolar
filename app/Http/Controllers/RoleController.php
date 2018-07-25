<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\role_has_permission;

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
        $roles = Role::all();
        $permissions = Permission::all();
        $roles_has_permissions = role_has_permission::all();
        return view('roles.index',compact('roles','permissions','roles_has_permissions'));
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

        if($request->has('modificar')):
            $role->givePermissionTo('Modificar');
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
        //
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
        //
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
