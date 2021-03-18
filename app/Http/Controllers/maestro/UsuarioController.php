<?php

namespace App\Http\Controllers\maestro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rol;
use App\User;
class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }
    public function index()
    {
        $roles= Rol::where('id','<>',1)->pluck('nombre','id');
        return view("maestro.usuarios.index",compact('roles'));
    }
    public function data(){
        $query = User::where("id","<>",1)->get();
        if($query->count()<1)
        return $this->data_null;

        // return $query;
        foreach ($query as $dato) {
            //return $dato->tipoproceso;
                $config = ' <div class="btn-group">';
                $config.= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>';
                $config.= "<div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                    <button class='dropdown-item'  class='btn' onclick='editar($dato->id)'><i class='ti-pencil-alt'></i> Editar</a>
                                </div>
                            </div>";
                
                            $usuarios_all = $dato->nombres.' '.$dato->apellido_paterno.' '.$dato-> apellido_materno;
                            $dni=$dato->dni;
                            $foto="<img src='$dato->img' height='45px'/>";
                            $roles=$dato->roles->pluck('nombre');
        

                            $data['aaData'][] = [$config,$dato->id,$dni,$usuarios_all,$foto, $roles];
        }
        return json_encode($data, true);      
    }

    

    public function edit($id)
    {
        $user = User::find($id);
        return 
            [
                "usuario"  =>  $user,
                "roles"    =>  $user->roles->pluck("id")
            ];
    }
    
    public function update(Request $r, $id)
    {
        $q=User::find($id);
        $q->nombres=$r->nombres;
        $q->apellido_paterno=$r->apellido_paterno;
        $q->apellido_materno=$r->apellido_materno;
        if($q->password!=""){
            $q->password=bcrypt($r->password);
        }
        $q->save();
        $q->roles()->sync($r->roles);
        return $q->roles;
       
    }
}
