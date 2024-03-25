<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapacitacionUser extends Model
{
    protected $table = 'capacitacion_users';
	protected $primaryKey = 'id';
    protected $fillable = ['user_id','es_curso_espec','es_especializacion','es_diplomado','es_ofimatica','es_idioma','es_certificado','es_licencia','centro_estudios','especialidad',
                            'ciudad','fecha_inicio','fecha_fin','pais','archivo','archivo_tipo','cantidad_horas','nivel'];
    public $timestamps = False;
    
    public function user() {
		return $this->belongsTo(User::class);
	}
}
