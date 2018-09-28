<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Degree;
use App\User;
use App\office;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
class DegreesController extends Controller
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
        $user = \Auth::user();
        if($user->hasRole('Administrador') || $user->hasRole('Coordinador') || $user->hasRole('Docente')):
            $busqueda = Input::get('busqueda');
            $degrees = Degree::whereStatus('1')
                ->where('degree_name','like',"%$busqueda%")
                ->paginate(15);
            return view('Degrees.index', compact('degrees','busqueda'))->with('status','nada'); 
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
        $users = User::whereActive('1')->get();
        $offices = office::whereStatus('1')->get();
        return view('Degrees.create', compact('users', 'offices'));
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
            'card_id'=>'unique:degrees|max:20|required',
            'degree_name' => 'unique:degrees|required',
            'user_id' => 'required',
            'semesters' => 'required|gte:1',
            'description' => 'nullable|max:50'
        ],[
            'card_id.unique' => 'La clave introducida ya ha sido registrada',
            'card_id.max' => 'El tamaño de la clave introducida es mayor al permitido',
            'degree_name.unique' => 'El nombre de la carrera ya ha sido registrado',
            'semesters.gte' => 'El número de semestres debe ser mayor a 0',
            'description.max' => 'La descripción supera el tamaño permitido'
        ]); 
        
        $degree = new Degree();
        $degree->card_id = $request->card_id;
        $degree->degree_name = $request->degree_name;
        $degree->semesters = $request->semesters;
        $degree->description = $request->description;
        $degree->rvoe = $request->rvoe;
        $degree->office_id = $request->office_id;
        $degree->user_id = $request->user_id;
        $degree->mode =$request->mode;

        $degree->save();

        return redirect()->route('Degrees')->withStatus('Carrera registrada correctamente');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $degree = Degree::findOrfail($id);
        return view('Degrees.show', compact('degree'));
    }

    public function disabled(){

        $busqueda = Input::get('busqueda');
        $degrees = Degree::whereStatus('0')
            ->where('Degree_name','like',"%$busqueda%")
            ->paginate(15);
        return view('Degrees.disabled', compact('degrees', 'busqueda'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::whereActive('1')->get();
        $offices = office::whereStatus('1')->get();
        $degree = Degree::findOrfail($id);
        return view('Degrees.edit', compact('users','degree','offices'));
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
        $this->validate($request, [
            'card_id' => ['required','max:20', Rule::unique('degrees')->ignore($request->id)],
            'degree_name' => ['required', Rule::unique('degrees')->ignore($request->id)],
            'user_id' => 'required',
            'semesters' => 'required|gte:1',
            'description' => 'nullable|max:50'
        ], [
            'card_id.unique' => 'La clave introducida ya ha sido registrada',
            'card_id.max' => 'El tamaño de la clave introducida es mayor al permitido',
            'degree_name.unique' => 'El nombre de la carrera ya ha sido registrado',
            'semesters.gte' => 'El número de semestres debe ser mayor a 0',
            'description.max' => 'La descripción supera el tamaño permitido'
        ]);

        $degree = Degree::findOrfail($id);
        $degree->card_id = $request->card_id;
        $degree->rvoe = $request->rvoe;
        $degree->degree_name = $request->degree_name;
        $degree->semesters = $request->semesters;
        $degree->user_id = $request->user_id;
        $degree->description = $request->description;
        $degree->office_id = $request->office_id;
        $degree->mode = $request->mode;
        
        $degree->save();

        return redirect()->route('Degrees')->withStatus('La carrera ha sido mofidicada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function disable(Request $request){

        //verifiar si la carrera tiene materias activas
        //solicitar desactivar las materias antes de continuar o si desea desactivarlas junto con la carrera
        if(\Auth::user()->hasRole('Administrador')):
            $degree = Degree::findOrfail($request->id);
            $degree->status = 0;
            $degree->save();

            return redirect()->route('Degrees')->with('status','Carrera desactivada correctamente');
        else:
            abort(404);
        endif;
        
    }

    public function reactivate(Request $request){
        $degree = Degree::findOrfail($request->id);
        $degree->status = 1;
        $degree->save();
        return redirect()->route('DegreesDisabled')->withStatus('La carrera ha sido activada correctamente');
    }

    public function destroy(Request $request)
    {
        $degree = Degree::findOrfail($request->id);
        $degree->delete();

        return redirect()->route('DegreesDisabled')->withStatus('La carrera ha sido eliminada correctamente');

    }
}
