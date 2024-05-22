<?php

namespace App\Http\Controllers\maestro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProcesosExport;
use App\TipoProceso;


class ReportesController extends Controller
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

    public function index(){
        return view("maestro.reportes.index");
    }

    
    public function descargaGanadores($fecha){
             
        $hoy = date("Ymd_His"); 

        $data["codigos"] = collect(\DB::select("SELECT MIN(pr.cod) primero, MAX(pr.cod) ultimo FROM postulantes p inner join procesos pr on pr.id = p.proceso_id where condicion = 'GANADOR' and pr.fecha_aprobacion = '$fecha'"))->first(); 

        $data["ganadores"] = \DB::select("SELECT p.condicion,p.email,u.dni,concat(u.apellido_paterno,' ',u.apellido_materno,' ',u.nombres) as nombres,pr.cod,pr.oficina,pr.remuneracion,d.telefono_celular,d.domicilio,d.fecha_nacimiento,d.ruc,pr.nombre 
            FROM postulantes p 
            inner join users u on p.user_id = u.id 
            inner join procesos pr on pr.id = p.proceso_id 
            inner join datos_users d on d.user_id = u.id 
            where condicion = 'GANADOR' and pr.tipo_id in ('1','4','5') and pr.fecha_aprobacion = '$fecha' ");                                

        $data["ruta"] = "reportes.excel.ganadores";
        //return (new ProcesosExport ($data))->view();
        //dd($data);
        return (new ProcesosExport($data))->download("lista_ganadores_".$hoy.'.xlsx');
                           
    }
}