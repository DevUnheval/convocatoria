<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FormacionPostulante;
class Postulante extends Model
{
    protected $table = 'postulantes';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','proceso_id',
							'ev_curricular','ev_conocimiento','ev_entrevista',
							'cal_curricular','cal_conocimientos','cal_entrevista',
							'obs_curricular','obs_conocimientos','obs_entrevista',
							'bonific_deportista','bonific_ffaa','bonific_pers_disc',
							'total','final','condicion'];
	//public $timestamps = False;


	public function proceso() {
		return $this->belongsTo(Proceso::class);
	}
	public function datos_postulante() {
		return $this->hasOne(DatosPostulante::class);
	}
	public function formacion_postulante() {
		return $this->hasMany(FormacionPostulante::class);
		//return $this->hasOne(Phone::class, 'foreign_key', 'local_key');
	}
	public function capacitacionpostulantes() {
		return $this->hasMany(CapacitacionPostulante::class);
	}
	public function experieciapostulantes() {
		return $this->hasMany(ExperienciaLabPostulante::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function get_especialidad() {
		$formacionPosulante = FormacionPostulante::where("postulante_id",$this->id)->get();
		$formacion ="";
		$temporal = "";
		foreach($formacionPosulante as $fila){
			if($fila->especialidad != $temporal ){//si es lo mismo para que no se repita
				if($formacion!=""){
					$formacion .= " - ".$fila->especialidad;
				}else $formacion .= $fila->especialidad;
				
			}
			$temporal = $fila->especialidad;                  
		}
		return $formacion;
	}
}
