<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Degree;
use App\Scholarship;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


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
                ->where(DB::raw("CONCAT(name,' ',names,' ',maternal_surname,' ',paternal_surname)"),'like',"%$busqueda%")
                ->paginate(15);
            return view('Students.index', compact('students','busqueda'));
        else:
            abort(404);
        endif;
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
            return view('Students.create', compact('degrees','scholarships'));
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
        $maternal = substr($maternal,0,2);
        $paternal = strtoupper($request->paternal_surname);
        $paternal = substr($paternal,0,2);
        $names = strtoupper($request->names);
        $names = substr($names,0,2);

        dd($paternal.$maternal.$names);
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
