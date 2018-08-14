<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Scholarship;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
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

     public function index($id)
    {
        $User = User::findOrfail($id);
        $scholarships = Scholarship::whereActive('1')->get();
        $roles = Role::all();
        $edit = false;
        return view('profile.index', compact('User','edit','scholarships','roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $User = User::findOrfail($id);
        $scholarships = Scholarship::whereActive('1')->get();
        $edit = true;
        $roles = Role::all();
        return view('profile.index', compact('User','edit','scholarships','roles'));
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
        $User = User::findOrfail($id);

        if($request->hasFile('profile_picture')):

            $this->validate($request,[
                'profile_picture' => 'required|image|max:3072'
            ]);

            if(\File::exists(public_path('/images/profile_pictures/',$User->id))):
                \File::delete(public_path('/images/profile_pictures/'.$User->id));
            endif;

            $file = $request->file('profile_picture');
            $name = $User->id;
            //$extesion = $file->getClientOriginalExtension();
            $file->move(public_path().'/images/profile_pictures/',$name);

            $User->profile_picture = $name;
            $User->save();
            return redirect()->route('ProfileUser',['id'=>$User->id])
            ->with('status','Foto de perfil actualizada correctamente');

        else:

            $User->name = $request->name;
            $User->email = $request->email;
            $User->names =$request->names;
            $User->paternal_surname = $request->paternal_surname;
            $User->maternal_surname = $request->maternal_surname;
            $User->gender = $request->gender;
            $User->birthdate =$request->birthdate;
            $User->curp =$request->curp;
            $User->state =$request->state;
            $User->municipality =$request->municipality;
            $User->colony =$request->colony;
            $User->street =$request->street;
            $User->external_number =$request->external_number;
            $User->internal_number =$request->internal_number;
            $User->zipcode =$request->zipcode;
            $User->cellphone =$request->cellphone;
            $User->local_phone =$request->local_phone;
            $User->professional_license =$request->professional_license;
            $User->rfc =$request->rfc;
            $User->contact_name =$request->contact_name;
            $User->contact_number =$request->contact_number;
            $User->allergy =$request->allergy;
            $User->allergy_description =$request->allergy_description;
            $User->controlled_medication =$request->controlled_medication;
            $User->medication_description =$request->medication_description;
            
            $User->save();
        endif;

        return redirect()->route('ProfileUser',['id'=>$User->id])
        ->with('status','Información actualizada exitosamente');
    }

    public function updateAdmon(Request $request, $id){

        
        $user = User::findOrfail($id);
        $user->nip = $request->nip;
        $user->card_id = $request->card_id;
        $user->scholarship_id = $request->scholarship_id;
        $user->syncRoles();
        $user->assignRole($request->role);
        $user->save();

        return redirect()->route('ProfileUser', ['id' => $user->id])
        ->with('status', 'Información actualizada exitosamente');
    }

    public function deleteImage($id){

        $User = User::findOrfail($id);

        if (\File::exists(public_path('/images/profile_pictures/', $User->id))):

            \File::delete(public_path('/images/profile_pictures/'. $User->id));
        
        endif;

        $User->profile_picture = null;

        $User->save();

        return redirect()->route('ProfileUser',['id'=> $User->id])
        ->with('status','Imagen borrada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id){
        /*
            Comprobar que rol tiene el usuario,
            Si es maestro, comprobar que no tenga materias asignadas
            si es así, notificar que deben de reasignar las materias o darlas de baja
            Si es coordinador, comprobar que no tenga carrera asignada, si es asi,
            notificar que debe ser reasignada primero antes de continuar.
        */

        $user = User::findOrfail($id);
        $user->active = 0;
        $user->save();
        
        if($user->id == Auth::user()->id):
           Auth::logout();
           return redirect()->route('inicio')->withErrors('Su cuenta ha sido desactivada');
        else:
            if ($user->hasRole('Administrador') || $user->hasRole('Coordinador')):
                return redirect()->route('administrativos')->with('status', 'Usuario desactivado correctamente');
            endif;
        endif;
    }

    public function destroy($id)
    {
        
    }
}
