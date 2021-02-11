<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLabUser extends Model
{
    protected $table = 'experiencia_lab_users';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','es_exp_gen','es_exp_esp',
							'tipo_institucion','tipo_experiencia',
							'centro_laboral','cargo_funcion','desc_cargo_funcion','fecha_inicio',
                            'fecha_fin','dias_exp_gen','dias_exp_esp'];
	public $timestamps = False;

	public function user() {
		return $this->belongsTo(User::class);
	}
}
