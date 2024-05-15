<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionProceso extends Model
{
    protected $table = 'evaluacion_procesos';
	protected $primaryKey = 'id';
	protected $fillable = ['proceso_id','nombre','archivo','archivo_tipo','fecha_publicacion'];
	public $timestamps = False;

	public function proceso() {
		return $this->belongsTo(Proceso::class);
	}
}
