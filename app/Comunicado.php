<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = 'comunicados';
	protected $primaryKey = 'id';
	protected $fillable = ['proceso_id','nombre','descripcion','archivo','archivo_tipo'];
	//public $timestamps = False;

	public function proceso() {
		return $this->belongsTo(Proceso::class);
	}
}
