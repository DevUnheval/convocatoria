<?php

namespace App;
use Carbon\Carbon;
use App\Comunicado;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'procesos';
	  protected $primaryKey = 'id';
    protected $fillable = ['tipo_id','etapa_evaluacion','estado','cod','nombre','especialidad',
                           'habilidades','capacitaciones','remuneracion',
                           'descripcion','n_plazas','oficina','archivo_bases','archivo_bases_tipo',
                           'archivo_resolucion','archivo_resolucion_tipo','contrato_inicio','evaluar_conocimientos',
                           'bon_ffaa','bon_pers_disc','bon_deport','bon_otros1','bon_otros2','pje_otro','pje_max_cv',
                           'consid_prac_preprof','consid_prac_prof',
                           'pje_min_cv','pje_max_conoc','pje_min_conoc','pje_max_entrev','pje_min_entrev','dias_exp_lab_gen',
                           'dias_exp_lab_esp','horas_cap_total','horas_cap_ind','fecha_aprobacion','fecha_publicacion',
                           'fecha_inscripcion_inicio','fecha_inscripcion_fin','fecha_resultados','fecha_firma_contrato',
                           'peso_cv','peso_conoc','peso_entrev',
                           'hay_bon_pers_disc','hay_bon_ffaa','hay_bon_deport',
                           'duracion_contrato','archivo_preliminar',
                           'nivel_acad_convocar','nivel_acad_evaluar','especialiad',
                           'archivo_preliminar_tipo','archivo_resultado','archivo_resultado_tipo'];
    // public $timestamps = False;
    
    public function postulantes() {
		return $this->hasMany(Postulante::class);
    }
    public function comunicados() {
		return $this->hasMany(Comunicado::class);
    }
    public function evaluacionprocesos() {
		return $this->hasMany(EvaluacionProceso::class);
    }
    public function tipoproceso() {
		return $this->belongsTo(TipoProceso::class,'tipo_id');
    }
    public function getFechaInscripcionInicioAttribute($value){
    return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
    public function getFechaInscripcionFinAttribute($value){
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
    public function ultimo_comunicado(){
      return Comunicado::where("proceso_id",$this->id)->orderBy("id","desc")->first();		
    }
}
