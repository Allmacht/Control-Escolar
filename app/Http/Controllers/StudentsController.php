<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Degree;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            return view('Students.create', compact('degrees'));
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
