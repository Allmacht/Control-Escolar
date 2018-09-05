<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Degree;
use App\User;
use Illuminate\Support\Facades\Input;
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
                ->paginate(1);
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
        return view('Degrees.create', compact('users'));
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
        $degree = Degree::findOrfail($id);
        return view('Degrees.show', compact('degree'));
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

    public function disabled(Request $request){
        if(\Auth::user()->hasRole('Administrador')):
            $degree = Degree::findOrfail($request->id);
            $degree->status = 0;
            $degree->save();

            return redirect()->route('Degrees')->with('status','Carrera desactivada correctamente');
        else:
            abort(404);
        endif;
        
    }

    public function destroy($id)
    {
        //
    }
}
