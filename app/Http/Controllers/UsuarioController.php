<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRol;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
//use App\Http\Controllers\OrderShipped;

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
        

        if (DB::table('users')->where('dni',$request->dni)->exists()) {
            $validatedData = $request->validate([
            'dni' =>'required|unique:users',
            'email' =>'required|unique:users',
            'password' =>'required|confirmed',
            
            ]);
            
            return redirect('/registro')->with('mensaje','El DNI ya existe!');
        }if((DB::table('users')->where('email',$request->email)->exists())){
            $validatedData = $request->validate([
                'dni' =>'required|unique:users',
                'email' =>'required|unique:users',
                'password' =>'required|confirmed',
                
                ]);
                
                return redirect('/registro')->with('mensaje','Este correo ya existe!');
        } else {
        
        $Usuario = new User();
        $Usuario->dni = $request->dni;
        $Usuario->nombres = $request->nombres;
        $Usuario->apellido_paterno = $request->apellido_paterno;
        $Usuario->apellido_materno = $request->apellido_materno;
        $Usuario->email = $request->email;
        $Usuario->password = Hash::make($request->password);
        $Usuario->save();
        
        $dnibuscado = DB::table('users')->where('dni', $request->dni)->value('id');
        $rol = new UserRol();
        $rol->user_id =$dnibuscado;
        $rol->rol_id = 3;
        $rol->save();

        $this->guard()->login($Usuario); //autologin despues de guardar el registro
        //Mail::to($request->user())->send();
        $correo=$request->email;
        $request->user()->sendEmailVerificationNotification(); //envio de correo de confirmación
        return redirect('/email/verify')->with('correo',$correo);
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
