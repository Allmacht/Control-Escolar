<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Degree;
use App\Scholarship;
use App\office;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class StudentsController extends Controller
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
        if(\Auth::user()->hasRole('Administrador') || \Auth::user()->hasRole('Coordinador')):
            
            $busqueda = Input::get('busqueda');
            $students = User::whereActive('1')
                ->where(DB::raw("CONCAT(card_id,' ',name,' ',names,' ',maternal_surname,' ',paternal_surname,' ',level)"),'like',"%$busqueda%")
                ->paginate(15);
            return view('Students.index', compact('students','busqueda'));
        else:
            abort(404);
        endif;
    }

    public function getDegrees(Request $request, $id){
        if($request->ajax()):
            $degrees = Degree::Degrees($id);
            return response()->json($degrees);
        endif;
    }

    public function disabled(){
        $busqueda = Input::get('busqueda');
        $students = User::whereActive('0')
            ->where(DB::raw("CONCAT(card_id,' ',names,' ',maternal_surname,' ',paternal_surname,' ',level)"),'like',"%$busqueda%")
            ->paginate(15);
        return view('Students.disabled', compact('students','busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->hasRole('Administrador') || \Auth::user()->hasRole('Coordinador')):
            $degrees = Degree::whereStatus('1')->get();
            $scholarships = Scholarship::whereActive('1')->get();
            $offices = office::whereStatus('1')->get();
            return view('Students.create', compact('degrees','scholarships', 'offices'));
        else:   
            abort(404);
        endif;
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
            'name'=>'required|unique:users',
            'email' => 'unique:users',
            'curp' => 'required|unique:users|min:18|max:18',
            'zipcode' => 'required|min:5|max:5',
            'cellphone' => 'required|min:10|max:10',
            'password' => 'required|min:8'
        ],[
            'name.unique' => 'El nombre de usuario ya está registrado',
            'email.unique'=> 'El email ya está en uso',
            'curp.unique' => 'El curp ya ha sido registrado',
            'curp.min' => 'El curp necesita tener 18 caracteres como mínimo',
            'curp.max' => 'El curp necesita tener 18 caracteres como máximo',
            'zipcode.min' => 'El código postal requiere mínimo 5 caracteres',
            'zipcode.max' => 'El código postal requiere máximo 5 caracteres',
            'cellphone.min' => 'El número de celular requiere 10 caracteres mínimo',
            'cellphone.max' => 'El número de celular requiere 10 caracteres máximo',
            'password.min' => 'La contraseña requiere mínimo 8 caracteres'
        ]);

        //card id
        $maternal = strtoupper($request->maternal_surname);
        $maternal = substr($maternal,0,1);
        $paternal = strtoupper($request->paternal_surname);
        $paternal = substr($paternal,0,1);
        $names = strtoupper($request->names);
        $names = substr($names,0,2);
        $level = strtoupper($request->level);
        $level = substr($level,0,3);

        if($request->degree_id):
            $degree = Degree::whereId($request->degree_id)->value('card_id');
            $degree = strtoupper($degree);
            $degree = substr($degree,-4);
            $card_id = $paternal.$maternal.$names."-".$level."-".$degree;
        else:
            if($request->office_id):
                $office = office::whereId($request->office_id)->value('card_id');
                $office = strtoupper($office);
                $office = substr($office,-4);
                $card_id = $paternal . $maternal . $names . "-" . $level . "-" . $office;  
            endif;
        endif;

        $user = new User();
        $user->card_id = $card_id;
        $user->name = $request->name;
        $user->names = $request->names;
        $user->maternal_surname = $request->maternal_surname;
        $user->paternal_surname = $request->paternal_surname;
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
        $user->degree_id = $request->degree_id;
        $user->contact_name = $request->contact_name;
        $user->contact_number = $request->contact_number;
        $user->allergy = $request->allergy;
        $user->allergy_description = $request->allergy_description;
        $user->controlled_medication = $request->controlled_medication;
        $user->medication_description = $request->medication_description;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->semester = '1';
        $user->password = Hash::make($request->password);

        $user->scholarship_id = $request->scholarchip_id;

        if($request->level != "Preparatoria"):
            $office_id = Degree::whereId($request->degree_id)->value('office_id');
            $user->office_id = $office_id;
        else:
            $user->office_id = $request->office_id;
        endif;

        $user->save();

        $user->assignRole('Alumno');

        return redirect()->route('Students')->withStatus('Alumno registrado correctamente');
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

    public function activate(Request $request){

        $student = User::findOrfail($request->id);
        $student->active = '1';
        $student->save();
        return redirect()->route('StudentsDisabled')->withStatus('Cuenta activada correctamente');
    }

    public function destroy(Request $request)
    {
        $student = User::findOrfail($request->id);
        $student->delete();
        return redirect()->route('StudentsDisabled')->withStatus('Cuenta eliminada correctamente');
    }
}
