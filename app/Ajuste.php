<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table = 'ajustes';
	protected $primaryKey = 'id';
	protected $fillable = ['nombre','valor','descripcion','tipo'];
	public $timestamps = False;

	public function elemento($nombre){
      return Ajuste::where('nombre',$nombre)->first()->valor;
   }
}
