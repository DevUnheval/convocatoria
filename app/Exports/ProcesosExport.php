<?php

namespace App\Exports;

use App\Proceso;
use DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Postulante;

class ProcesosExport implements FromView {
    use Exportable;
    
    public function __construct(int $proceso_id){
        $this->postulantes =  Postulante::where("proceso_id",$proceso_id)->get();
    }


    public function view(): View
    {
        return view('reportes.excel.etapa', [
            'postulantes' => $this->postulantes,
        ]);
    }
}
