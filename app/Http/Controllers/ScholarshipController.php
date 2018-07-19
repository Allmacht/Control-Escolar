<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scholarship;
use Illuminate\Support\Facades\Input;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

     public function index()
    {

        $create = false;
        $busqueda = Input::get('busqueda');
        $scholarships = Scholarship::whereActive('1')->where('name','like','%'.$busqueda.'%')->paginate(10);
        return view('Scholarship.index',compact('scholarships','busqueda','create'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = true;
        $busqueda = Input::get('busqueda');
        $scholarships = Scholarship::whereActive('1')->where('name','like','%'.$busqueda.'%')->paginate(10);
        return view('Scholarship.index',compact('scholarships','busqueda','create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scholar = new Scholarship();
        $scholar->name = $request->name;
        $scholar->description = $request->description;
        $scholar->level = $request->level;
        $scholar->provider = $request->provider;

        $scholar->save();

        return redirect()->route('Scholarships')->with('status','Beca registrada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scholarship = Scholarship::findOrfail($id);
        return view('Scholarship.show', compact('scholarship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scholarship = Scholarship::findOrfail($id);
        return view('Scholarship.edit',compact('scholarship'));
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
        $scholar = Scholarship::findOrfail($id);
        $scholar->name = $request->name;
        $scholar->description = $request->description;
        $scholar->level = $request->level;
        $scholar->provider = $request->provider;

        $scholar->save();

        return redirect()->route('Scholarships')->with('status','Datos actualizados correctamente');

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
