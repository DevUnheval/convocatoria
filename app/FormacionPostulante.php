<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormacionPostulante extends Model
{
    protected $table = 'formacion_postulantes';
    protected $primaryKey = 'id';
    protected $fillable = ['postulante_id','grado_id','fecha_inicio','fecha_fin','fecha_expedicion','centro_estudios','especialidad',
                              'ciudad','pais','archivo','archivo_tipo'];
    public $timestamps = False;
    
    public function postulante() {
		return $this->belongsTo(Postulante::class);
  }
  public function gradoformacion() {
		return $this->belongsTo(GradoFormacion::class,'grado_id','id');
	}
}
