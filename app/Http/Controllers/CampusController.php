<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\office;
use App\User;
use App\Degree;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CampusController extends Controller
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
        $offices = office::whereStatus('1')
            ->where(DB::raw("CONCAT(card_id,' ',name)"),'like',"%$busqueda%")
            ->paginate(15);
        return view('Campus.index', compact('offices','busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereActive('1')->get();
        return view('Campus.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:offices',
        ],[
            'name.unique' => 'El nombre ingresado ya está en uso'
        ]);

        $office = new office();
        $office->card_id = $request->card_id;
        $office->name = $request->name;
        $office->country = $request->country;
        $office->state = $request->state;
        $office->municipality = $request->municipality;
        $office->street = $request->street;
        $office->external_number = $request->external_number;
        $office->internal_number = $request->internal_number;
        $office->zipcode = $request->zipcode;
        $office->local_phone = $request->local_phone;
        $office->type = $request->type;
        $office->user_id = $request->user_id;

        $office->save();
        return redirect()->route('Campus')->withStatus('Plantel registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campus = office::findOrfail($id);
        return view('Campus.show', compact('campus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campus = office::findOrfail($id);
        $users = User::whereActive('1')->get();

        return view('Campus.edit', compact('campus', 'users'));

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
        $campus = office::findOrfail($id);
        
        $this->validate($request, [
            'card_id' => ['required',Rule::unique('offices')->ignore($request->id)],
            'name' => ['required', Rule::unique('offices')->ignore($request->id)],
        ],[
            'card_id.unique' => 'La clave introducida ya ha sido registrada',
            'name.unique' => 'El nombre introducido ya ha sido registrado'
        ]);

        $campus->card_id = $request->card_id;
        $campus->name = $request->name;
        $campus->country = $request->country;
        $campus->state = $request->state;
        $campus->municipality = $request->municipality;
        $campus->street = $request->street;
        $campus->external_number = $request->external_number;
        $campus->internal_number = $request->internal_number;
        $campus->zipcode = $request->zipcode;
        $campus->local_phone = $request->local_phone;
        $campus->type = $request->type;
        $campus->user_id = $request->user_id;
        
        $campus->save();

        return redirect()->route('Campus')->withStatus('Datos actualizados correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function disable(Request $request){

        /*
            Comprobar si existen materias carreras activas dentro del plantel
            En caso de existir, sugerir que se desactiven primero las carreras y ofrecer la 
            opción de realizarlo. En caso contrario no realizar ninguna acción
        */
        
        $office = office::findOrfail($request->id);
        $degrees = Degree::whereStatus('1')->where('office_id','=',$request->id)->get();

        if($degrees->isEmpty()):
            $office->status = 0;
            $office->save();
            return redirect()->route('Campus')->withStatus('Plantel desactivado correctamente');
        else:
            return redirect()->route('Campus')->withErrors('El plantel tiene carreras activas');
        endif;

        
    }

    public function disabled(){
        $busqueda = Input::get('busqueda');
        $offices = office::whereStatus('0')
            ->where(DB::raw("CONCAT(card_id,' ',name)"),'like',"%$busqueda%")
            ->paginate(15);
        return view('Campus.disabled', compact('offices', 'busqueda'));
    }

    public function activate(Request $request){
        $campus = office::findOrfail($request->id);
        $campus->status = 1;
        $campus->save();

        return redirect()->route('CampusDisabled')->withStatus('Plantel activado correctamente');
    }

    public function destroy(Request $request)
    {
        $campus = office::findOrfail($request->id);
        $campus->delete();

        return redirect()->route('CampusDisabled')->withStatus('Plantel eliminado correctamente');
    }
}
