<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapacitacionPostulante extends Model
{
    protected $table = 'capacitacion_postulantes';
	protected $primaryKey = 'id';
    protected $fillable = ['postulante_id','es_curso_espec','es_ofimatica','es_idioma','centro_estudios','especialidad',
                            'ciudad','fecha_inicio','fecha_fin','pais','archivo','archivo_tipo','cantidad_horas','nivel'];                            
    public $timestamps = False;
    
    public function postulante() {
		return $this->belongsTo(Postulante::class);
	}
}
