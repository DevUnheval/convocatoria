<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProcesosExport;
use App\Proceso;

use PDF; 
use App\Postulante;
use DB;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
// use Xthiago\PDFVersionConverter\Guesser\RegexGuesser;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->api= app(\App\Http\Controllers\PostulantesController::class);
        //nuestros archivos tienen nombres muy largos, eso sumado a las rutas, lo hacen muy largas,
        //y sale error, así que sacamos una copia a todo, le ponemos un nombre temporal y SOLUCIONADO
        $this->archivos_temporales=[]; 
    }
    public function pdf ($id,$etapa){
        if($etapa=="0"){
            $data = $this->data_resultado($id,$etapa);
            $pdf = PDF::loadView('reportes.pdf.resultado',compact('data'))->setPaper('a4', 'landscape');
            return $pdf->stream("Resultado_".$data['proceso']->cod.'.pdf'); //download
        }
        $data = $this->data_etapa($id,$etapa);
        //$pdf = PDF::loadView('reportes.pdf.procesos',compact('data'));
        $pdf = PDF::loadView('reportes.pdf.procesos',compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream("etapa_".$etapa."_".$data['proceso']->cod.'.pdf'); //download
    }

    public function excel($id,$etapa){
        if($etapa=="0"){
            $data = $this->data_resultado($id);
            $data["ruta"] = "reportes.excel.resultado";
            //return (new ProcesosExport($data))->view();
            return (new ProcesosExport($data))->download("Resultado_".$etapa."_".$data['proceso']->cod.'.xlsx');
        }
            $data = $this->data_etapa($id,$etapa);
            $data["ruta"] = "reportes.excel.etapa";
            return (new ProcesosExport($data))->download("etapa_".$etapa."_".$data['proceso']->cod.'.xlsx');
            //return (new ProcesosExport)->view();
        
    }

    private function data_etapa($proceso_id, $etapa){
        $etapa_id = (int) $etapa;
        $proceso =  Proceso::find($proceso_id);      
        
        $proceso_enca = \DB::select("SELECT * from procesos where estado = '1' or estado = '2' order by id");

        $codpro = \DB::select("SELECT id from procesos where estado = '1' or estado = '2' order by id");

        foreach($codpro as $key=>$cod){
            $postu[$key] = Postulante::select( "telefono_celular",DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"))
               /* ->join("users","users.id","=","postulantes.user_id")->where('proceso_id',$id)*/
            ->join("users","users.id","=","postulantes.user_id")
            ->join("procesos","procesos.id","=","postulantes.proceso_id")
            ->join("datos_postulantes","datos_postulantes.postulante_id","=","postulantes.id")
            //->where("estado","=","1")
            ->where('proceso_id',$cod->id)
            ->orderBy("apellido_paterno")->get();
        }
        
        $etapas = $this->api->etapas_evaluacion($proceso->evaluar_conocimientos);
       
        if( $etapa_id > count($etapas) ){
            return back();
        }
        if($etapa_id<1 || $etapa == null){
            $etapa_id = (int) $proceso->etapa_evaluacion;
        }
        $etapa_a_buscar = $etapa_id-1; //-1 porque los índices o posiciones empiezan en 0, y obtendremos los datos desde un array
        $calificacion_etapa_actual = $etapas[$etapa_a_buscar]['desc_bd'];//TEXTO/NOMBRE de la CALIFICACION ACTUAL; p.e cal_curricular, cal_entrevista 
        $calificacion_etapa_anterior = $etapas[$etapa_a_buscar]['desc_bd']; // por defecto la etapa anterior será la misma que la actual, xq no existe array de indice/posición <0 (...==>)
        $evaluacion_etapa_actual = $etapas[$etapa_a_buscar]['desc2_bd'];
        $query = Postulante::select( "proceso_id", "dni",
                                     DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"),
                                     "user_id",
                                     $calificacion_etapa_actual." as calificacion",
                                     $evaluacion_etapa_actual." as evaluacion",
                                     "obs_curricular","obs_entrevista"
                                    )
                            ->join("users","users.id","=","postulantes.user_id")
                            ->where('proceso_id',$proceso_id); //hasta aquí estamos de acuerdo, que muestre el proceso seleccionado 
        if($etapa_a_buscar>0){ //si es cero, mostrará a todos, caso contrario filtrará por etapas
            $calificacion_etapa_anterior = $etapas[$etapa_a_buscar-1]['desc_bd'];// (...=>) Pero en caso estemos en la etapa 2,3,..n; la etapa anterior será actual -1
            $query = $query->where($calificacion_etapa_anterior,1); //los que aprobaron en la etapa anterior se mostrará en esta vista        
        }
        $postulantes = $query->orderBy($evaluacion_etapa_actual,"desc")->get();
        $etapa_actual = $etapas[$etapa_a_buscar];
        return [
                    'proceso'       => $proceso,
                    'proceso_enca'  => $proceso_enca,
                    'postulantes'   => $postulantes,
                    'postu'         => $postu,
                    'etapa_actual'  => $etapa_actual,
                    'etapas'        => $etapas,
                ];
    }
    private function data_resultado($proceso_id){
        $proceso =  Proceso::find($proceso_id);      
        $etapas = $this->api->etapas_evaluacion($proceso->evaluar_conocimientos);
        $postulantes = Postulante::select( "dni",
                                     DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"),
                                     "user_id",
                                    "postulantes.*"
                                    )
                            ->join("users","users.id","=","postulantes.user_id")
                            ->where('proceso_id',$proceso_id)
                            //->where('cal_entrevista','1')
                            ->where('cal_entrevista','>=','0')
                            ->orderBy('final','desc')
                            ->orderBy('apellido_paterno','asc')
                            ->get();
        return [
                    'proceso'       => $proceso,
                    'postulantes'   => $postulantes,
                ];
    }
    public function preliminar($id,$tipo){

        $codpro = \DB::select("SELECT id from procesos where estado = '1' or estado = '2' order by id");

        foreach($codpro as $key=>$cod){
            $data[$key] = Postulante::select( "telefono_celular",DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"))
               /* ->join("users","users.id","=","postulantes.user_id")->where('proceso_id',$id)*/
            ->join("users","users.id","=","postulantes.user_id")
            ->join("procesos","procesos.id","=","postulantes.proceso_id")
            ->join("datos_postulantes","datos_postulantes.postulante_id","=","postulantes.id")
            //->where("estado","=","1")
            ->where('proceso_id',$cod->id)
            ->orderBy("apellido_paterno")->get();
        }
        
            //$proceso = Proceso::find($id);
           //$proceso = Proceso::select("*")->where('id','=','133')->get();
             $proceso = \DB::select("SELECT * from procesos where estado = '1' or estado = '2' order by id");
             // $proceso = Proceso::select("*")->where('id','=','133')->get();


            //dd($proceso);   
        if($tipo=="pdf"){
            $pdf = PDF::loadView('reportes.pdf.preliminar',compact('data','proceso'));
            return $pdf->stream("PRELIMINAR".'.pdf'); //download

        }
        if($tipo=="excel"){
            $data = $this->data_etapa($id,1);
            $data["ruta"] = "reportes.excel.preliminar";
            //return (new ProcesosExport($data))->view();
            return (new ProcesosExport($data))->download("preliminar_".$data['proceso']->cod.'.xlsx');

        }

    }
    public function cv2($id_postulante){
        $postulante = Postulante::find($id_postulante);   
        if(!$postulante->datos_postulante){
            return "Los datos del postulante no se guardaron correctamente. No se encontraron datos de postulante";
        }         
        $pdf = PDF::loadView('reportes.pdf.cv',compact('postulante'));
        
        $path_pdf0 = 'public/pdf/'.rand(1, 99999).'.pdf';
        Storage::put($path_pdf0, $pdf->output()); //almacenamos temporalemte el archivo
        
        $this->archivos_temporales[]=$path_pdf0;
        $pdfMerger = PDFMerger::init(); 
        //agregamos los documentos PDF
        //1. CV
        $pdfMerger->addPDF(storage_path("app/".$path_pdf0) , 'all');
        //return Storage::get($path_pdf0);

        //2. DNI
        $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_dni);         
        //2.1 COLEGIATURA
        if($postulante->datos_postulante->archivo_colegiatura)
        $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_colegiatura);
           
        $pdfMerger->merge(); //For a normal merge (No blank page added)
        // borramos los archivos temporales
        foreach($this->archivos_temporales as $temp){
           Storage::delete($temp);
        }

        //$guesser = new RegexGuesser();
        //echo $guesser->guess('/path/to/my/file.pdf'); // will print something like '1.4'

        return $pdfMerger->save("CV_".$postulante->dni.".pdf", "browser");
        
    }
    //-----------------------
    public function cv($id_postulante){
       
        $postulante = Postulante::find($id_postulante);   
        if(!$postulante->datos_postulante){
            return "Los datos del postulante no se guardaron correctamente. No se encontraron datos de postulante";
        }         
        $pdf = PDF::loadView('reportes.pdf.cv',compact('postulante'));
        
        $path_pdf0 = 'public/pdf/'.rand(1, 99999).'.pdf';
        Storage::put($path_pdf0, $pdf->output()); //almacenamos temporalemte el archivo
        
        $this->archivos_temporales[]=$path_pdf0;
        $pdfMerger = PDFMerger::init(); 
        //agregamos los documentos PDF
        //1. CV
        $pdfMerger->addPDF(storage_path("app/".$path_pdf0) , 'all');
        //return Storage::get($path_pdf0);
        
        //2. DNI
        $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_dni);         
        //2.1 COLEGIATURA
        if($postulante->datos_postulante->archivo_colegiatura)
        $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_colegiatura);
        //3. bonificaciones
        if($postulante->datos_postulante->es_lic_ffaa)
            $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_ffaa);
        if($postulante->datos_postulante->es_deportista)         
            $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_deport);
        if($postulante->datos_postulante->es_pers_disc)
            $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_disc);
        //4. Formación       
        foreach($postulante->formacion_postulante as $key => $formacion){
            if(!$formacion->validacion) continue;
            $this->fusionar_pdf($pdfMerger,  $formacion->archivo);            
        }
        //5. Capacitación       
        foreach($postulante->capacitacionpostulantes as $key => $capacitacion){
            if(!$capacitacion->validacion) continue;
            $this->fusionar_pdf($pdfMerger,  $capacitacion->archivo);            
        }
        //6. Experiencia laboral       
        foreach($postulante->experieciapostulantes as $key => $experiencia){
            if(!$experiencia->validacion) continue;
            $this->fusionar_pdf($pdfMerger,  $experiencia->archivo);            
        }   
        $pdfMerger->merge(); //For a normal merge (No blank page added)
        // borramos los archivos temporales
        foreach($this->archivos_temporales as $temp){
           Storage::delete($temp);
        }

        //$guesser = new RegexGuesser();
        //echo $guesser->guess('/path/to/my/file.pdf'); // will print something like '1.4'

        return $pdfMerger->save("CV_".$postulante->dni.".pdf", "browser");
        
    }


    public function cv1($id_postulante){
       
        $postulante = Postulante::find($id_postulante);   
        if(!$postulante->datos_postulante){
            return "Los datos del postulante no se guardaron correctamente. No se encontraron datos de postulante";
        }         
        $pdf = PDF::loadView('reportes.pdf.cv',compact('postulante'));
        
        $path_pdf0 = 'public/pdf/'.rand(1, 99999).'.pdf';
        Storage::put($path_pdf0, $pdf->output()); //almacenamos temporalemte el archivo
        
        $this->archivos_temporales[]=$path_pdf0;
        $pdfMerger = PDFMerger::init(); 
        //agregamos los documentos PDF
        //1. CV
        $pdfMerger->addPDF(storage_path("app/".$path_pdf0) , 'all');
        //return Storage::get($path_pdf0);
        
        //2. DNI
        $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_dni);         
        //2.1 COLEGIATURA
        if($postulante->datos_postulante->archivo_colegiatura)
        $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_colegiatura);
        //3. bonificaciones
        if($postulante->datos_postulante->es_lic_ffaa)
            $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_ffaa);
        if($postulante->datos_postulante->es_deportista)         
            $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_deport);
        if($postulante->datos_postulante->es_pers_disc)
            $this->fusionar_pdf($pdfMerger, $postulante->datos_postulante->archivo_disc);
        //4. Formación       
        foreach($postulante->formacion_postulante as $key => $formacion){
            //if(!$formacion->validacion) continue;
            $this->fusionar_pdf($pdfMerger,  $formacion->archivo);            
        }
        //5. Capacitación       
        foreach($postulante->capacitacionpostulantes as $key => $capacitacion){
            //if(!$capacitacion->validacion) continue;
            $this->fusionar_pdf($pdfMerger,  $capacitacion->archivo);            
        }
        //6. Experiencia laboral       
        foreach($postulante->experieciapostulantes as $key => $experiencia){
            //if(!$experiencia->validacion) continue;
            $this->fusionar_pdf($pdfMerger,  $experiencia->archivo);            
        }   
        $pdfMerger->merge(); //For a normal merge (No blank page added)
        // borramos los archivos temporales
        foreach($this->archivos_temporales as $temp){
           Storage::delete($temp);
        }

        //$guesser = new RegexGuesser();
        //echo $guesser->guess('/path/to/my/file.pdf'); // will print something like '1.4'

        return $pdfMerger->save("CV_".$postulante->dni.".pdf", "browser");
        
    }

    private function fusionar_pdf($pdfMerger,$rutaArchivoPDF){
        try {
            $_ext = substr($rutaArchivoPDF, -4);
            if(Storage::exists($rutaArchivoPDF) && $_ext == '.pdf'){
                $ruta_archivo_temporal = 'public/pdf/temp_'.rand(1,10000).'.pdf';
                Storage::copy($rutaArchivoPDF,$ruta_archivo_temporal);
                $this->archivos_temporales[]=$ruta_archivo_temporal;
                $pdfMerger->addPDF( storage_path("app/".$ruta_archivo_temporal) , 'all');
                unset($ruta_archivo_temporal);
            }else{
                $this->agregar_hoja_en_blanco($pdfMerger,$rutaArchivoPDF);
            }
        } catch (\Throwable $th) {
            $this->agregar_hoja_en_blanco($pdfMerger,$rutaArchivoPDF);

        } 
    }

    private function agregar_hoja_en_blanco($pdfMerger,$rutaArchivoPDF){
            $texto = "<h4>¡Error! La infomación contenida en esta hoja está corrupta o dañada.<br> </h4>";
            $ruta = asset(Storage::url($rutaArchivoPDF));
            $texto.="<p>Clic al siguiente enlace para ver el archivo original</p>";
            $texto.= "<a href=$ruta target='_blank'><small> $ruta </small><a>" ;
            $pdf = PDF::loadHTML($texto);
            $path_pdf0 = 'public/pdf/error_'.rand(1, 99999).'.pdf';
            Storage::put($path_pdf0, $pdf->output()); //almacenamos temporalemte el archivo
            $this->archivos_temporales[]=$path_pdf0;
            $this->fusionar_pdf($pdfMerger, $path_pdf0);
    }

    public function descargar_postulantes($id_proceso){
        $data["proceso"] = Proceso::find($id_proceso);
        $data["postulantes"] = Postulante::select( "dni",DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"),'postulantes.*')
                                        ->join("users","users.id","=","postulantes.user_id")->where('proceso_id',$id_proceso)
                                        ->orderBy("final","desc")
                                        ->orderBy("apellido_paterno")->get();
        $data["ruta"] = "reportes.excel.postulantes";
        //return (new ProcesosExport ($data))->view();
        return (new ProcesosExport($data))->download("postulantes_".$data['proceso']->cod.'.xlsx');
    }

    public function descargar_postulantes_view($id_proceso){
        $data["proceso"] = Proceso::find($id_proceso);
        $data["postulantes"] = Postulante::select( "dni",DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"),'postulantes.*')
                                        ->join("users","users.id","=","postulantes.user_id")->where('proceso_id',$id_proceso)
                                        ->orderBy("final","desc")
                                        ->orderBy("apellido_paterno")->get();
        $data["ruta"] = "reportes.excel.postulantes";
        return (new ProcesosExport ($data))->view();
        //return (new ProcesosExport($data))->download("postulantes_".$data['proceso']->cod.'.xlsx');
    }


}
