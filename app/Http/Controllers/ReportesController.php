<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProcesosExport;

use PDF; 
use App\Postulante;

class ReportesController extends Controller
{
    public function pdf ($id){
        $pdf = PDF::loadView('reportes.pdf.procesos');
        return $pdf->stream('pruebapdf.pdf'); //download
    }

    public function excel($proceso_id=1){
        //$postulantes=Postulante::where("proceso_id",$proceso_id)->get();
        //return (new ProcesosExport($proceso_id))->download('Reporte.xlsx');
        return (new ProcesosExport($proceso_id))->view();
    }
}
