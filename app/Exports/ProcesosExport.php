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
    
    public function __construct(array $data){
        $this->data = $data;
    }


    public function view(): View
    {
        return view($this->data["ruta"], [
            'data' => $this->data,
        ]);
    }
}
