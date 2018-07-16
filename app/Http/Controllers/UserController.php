<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $edit = false;
        $message = null;
        return view('profile.index', compact('User','edit','message'));

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
        $edit = true;
        $message = null;
        return view('profile.index', compact('User','edit','message'));
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
                \File::delete(public_path('/images/profile_pictures/',$User->id));
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
            $User->names = $request->name;
            $User->email = $request->email;
            $User->save();
        endif;

        return redirect()->route('ProfileUser',['id'=>$User->id])
        ->with('status','Información actualizada exitosamente');
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
