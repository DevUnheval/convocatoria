<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $table = 'postulantes';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','proceso_id',
							'ev_curricular','ev_conocimiento','ev_entrevista',
							'cal_curricular','cal_conocimientos','cal_entrevista','bonificacion','total'];
	//public $timestamps = False;


	public function proceso() {
		return $this->belongsTo(proceso::class);
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
	public function user() {
		return $this->belongsTo(user::class);
	}
}
