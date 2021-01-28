<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
	protected $table = 'tipo_procesos';	
	protected $primaryKey = 'id';
	protected $fillable = ['nombre','descripcion'];
	public $timestamps = False;

	public function procesos() {
		return $this->hasMany(Proceso::class);
	}
}
