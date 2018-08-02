<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $busqueda = input::get('busqueda');

        $users = User::whereActive('1')
        ->where(DB::raw("CONCAT(name, ' ',email)"),'like',"%$busqueda%")
        ->paginate(15);
        return view('users.index', compact('users','busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        $res = null;
        do{
            $nip = $this->nip();
            $users = User::whereNip($nip)->get();
            $res = $users->isEmpty();
        }while($res == false);
        
        return view('users.create', compact('roles','nip'));
    }

    function nip(){

        $nip = (string)rand(0, 9999);
        if (strlen($nip) < 4) {
            $nip = str_pad($nip, 4, "0", STR_PAD_LEFT);
        }
        return $nip;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'curp' => 'unique:users|min:18|max:18|required',
            'cellphone' => 'min:10|max:10',
            'professional_license' => 'nullable|unique:users|min:8|max:8',
            'rfc' => 'nullable|min:12|max:13|unique:users',
            'nip' => 'nullable|unique:users|max:4',
            'email' => 'unique:users',
            'name' => 'unique:users|min:3|max:12'
        ]);

        $user = new User();
        $user->names = $request->names;
        $user->paternal_surname = $request->paternal_surname;
        $user->maternal_surname = $request->maternal_surname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->curp = $request->curp;
        $user->state = $request->state;
        $user->municipality = $request->municipality;
        $user->colony = $request->colony;
        $user->street = $request->street;
        $user->external_number = $request->external_number;
        $user->internal_number = $request->internal_number;
        $user->zipcode = $request->zipcode;
        $user->cellphone = $request->cellphone;
        $user->local_phone = $request->local_phone;
        $user->contact_name = $request->contact_name;
        $user->contact_number = $request->contact_number;
        $user->allergy = $request->allergy;
        $user->allergy_description = $request->allergy_description;
        $user->controlled_medication = $request->controlled_medication;
        $user->medication_description = $request->medication_description;
        $user->professional_license = $request->professional_license;
        $user->rfc = $request->rfc;
        $user->nip = $request->nip;
        $user->card_id = $request->card_id;        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->assignRole($request->role);

        return redirect()->route('administrativos')->with('status','Administrativo registrado correctamente');
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
    public function destroy($id)
    {
        //
    }
}
