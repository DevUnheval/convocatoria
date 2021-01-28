<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    protected $table = 'ubigeos';
	protected $primaryKey = 'id';
	protected $fillable = ['id','type','descripcion','prov_id','dep_id'];
	public $timestamps = False;

}
