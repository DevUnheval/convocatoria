<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    protected $table = 'ubigeos';
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'id',
		'cod_dep_inei',	
		'desc_dep_inei',	
		'cod_prov_inei',	
		'desc_prov_inei',	
		'cod_ubigeo_inei',	
		'desc_ubigeo_inei',	
		'cod_dep_reniec',	
		'desc_dep_reniec',	
		'cod_prov_reniec',	
		'desc_prov_reniec',	
		'cod_ubigeo_reniec',	
		'desc_ubigeo_reniec',	
		'cod_dep_sunat',	
		'desc_dep_sunat',	
		'cod_prov_sunat',	
		'desc_prov_sunat',	
		'cod_ubigeo_sunat',	
		'desc_ubigeo_sunat',
];
	public $timestamps = False;

}
