<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormacionUser extends Model
{
    protected $table = 'formacion_users';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','grado_id','fecha_inicio','fecha_fin','fecha_expedicion','centro_estudios','especialidad',
                            'ciudad','pais','archivo','archivo_tipo'];
    public $timestamps = False;
    
    public function gradoformacion() {
		return $this->belongsTo(GradoFormacion::class);
  }
  public function user() {
		return $this->belongsTo(Users::class);
	}
}
