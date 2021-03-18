<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoFormacion extends Model
{
	protected $table = 'grado_formacions';	
	protected $primaryKey = 'id';
	protected $fillable = ['nombre','descripcion'];
	public $timestamps = False;

	public function formacionpostulantes() {
		return $this->hasMany(FormacionPostulante::class);
	}
	public function formacionusers() {
		return $this->hasMany(FormacionUser::class);
	}
}
