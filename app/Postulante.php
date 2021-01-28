<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $table = 'postulantes';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','proceso_id','ev_curricular','ev_conocimiento','ev_entrevista','bonificacion','total'];
	//public $timestamps = False;


	public function proceso() {
		return $this->belongsTo(proceso::class);
	}
	public function datospostulantes() {
		return $this->hasMany(DatosPostulante::class);
	}
	public function formacionpostulantes() {
		return $this->hasMany(FormacionPostulante::class);
	}
	public function capacitacionpostulantes() {
		return $this->hasMany(CapacitacionPostulante::class);
	}
	public function user() {
		return $this->belongsTo(user::class);
	}
}
