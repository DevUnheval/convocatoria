<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLabPostulante extends Model
{
    protected $table = 'experiencia_lab_postulantes';
	protected $primaryKey = 'id';
    protected $fillable = ['postulante_id','es_exp_gen','es_exp_esp',
                            'tipo_institucion','tipo_experiencia',                      
                            'centro_laboral','cargo_funcion','desc_cargo_funcion','fecha_inicio',
                            'fecha_fin','num_pag','dias_exp_gen','dias_exp_esp','archivo','archivo_tipo'];
    public $timestamps = False;
    
    
    public function user() {
		return $this->belongsTo(User::class);
	}
}
