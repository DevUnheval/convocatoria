<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

     public function index()
    {
        return view('auth.register');
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
    public function registrar(Request $request)
    {
        $Usuario = new User();

        if (DB::table('users')->where('dni',$request->dni)->exists()) {
            $validatedData = $request->validate([
            'dni' =>'required|unique:users',
            'email' =>'required',
            
            ]);
            return redirect('/registro')->with('mensaje','El DNI ya existe!');
        }else {
        
        $Usuario->dni = $request->dni;
        $Usuario->nombres = $request->nombres;
        $Usuario->apellido_paterno = $request->apellido_paterno;
        $Usuario->apellido_materno = $request->apellido_materno;
        $Usuario->email = $request->email;
        $Usuario->password = Hash::make($request->password);
                
        $Usuario->save();

        $this->guard()->login($Usuario); //autologin despues de guardar el registro
        return redirect()->route('postulante_inicio');
        //return redirect()->route('postulante_inicio', array('dni' => $request->dni, 'password' => $request->password));
        }
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
