<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosUser extends Model
{
    protected $table = 'datos_users';
	protected $primaryKey = 'id';
    protected $fillable = ['user_id','archivo_dni','archivo_dni_tipo','telefono_celular','telefono_fijo','ruc',
                            'domicilio','ubigeo_domicilio','fecha_nacimiento','ubigeo_nacimiento','nacionalidad','es_pers_disc','archivo_disc','archivo_disc_tipo',
                            'es_lic_ffaa','archivo_ffaa','archivo_ffaa_tipo','es_deportista','archivo_deport',
                            'archivo_deport_tipo','es_otros1','archivo_otro','archivo_otro_tipo','es_otros2',
                            'archivo_otro2','archivo_otro2_tipo','dj1','dj2','dj3','dj4','dj5','dj6',
                            'dj7','dj8','dj9','dj10','dj11','archivo1','archivo1_tipo','colegiatura','archivo_colegiatura'];
    public $timestamps = False;
    
    public function user() {
		return $this->belongsTo(User::class);
	}
}
