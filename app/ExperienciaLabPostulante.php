<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLabPostulante extends Model
{
    protected $table = 'experiencia_lab_postulantes';
	protected $primaryKey = 'id';
    protected $fillable = ['postulante_id','es_exp_gen','es_exp_esp',
                            'tipo_institucion','tipo_experiencia',                      
                            'centro_laboral','cargo_funcion','desc_cargo_funcion','fecha_inicio',
                            'fecha_fin','num_pag','dias_exp_gen','dias_exp_esp','archivo','archivo_tipo'];
    public $timestamps = False;
    
    
    public function user() {
		return $this->belongsTo(User::class);
	}
    public function tipoexperiencia() {
        switch($this->tipo_experiencia){
            case "1": $experiecia = "Exp. laboral"; break;
            case "2": $experiecia = "Practicas pre prof"; break;
            case "3": $experiecia = "Practicas profeionales"; break;
            default: $experiecia = "No definido";
        }
		return $experiecia;
	}
    public function calcular_expericia(){
        $diasx = $this->dias_exp_gen;
        $anios = 0; $meses=0; $dias =0; 
        $anios_desc=""; $meses_desc=""; $dias_desc="";
        $anios = intval($diasx/365); 
        $meses = intval(($diasx%365)/30.4);
        $dias  = intval(($diasx%365)%30.4);

        if($anios == 0){
            $anios_desc = "";
            $anios = "";
        }else if($anios == 1){
            $anios_desc = "año";
        }else if($anios > 1){
            $anios_desc = "años";
        }

        if($meses == 0){
            $meses_desc = "";
            $meses = "";
        }else if($meses == 1){
            $meses_desc = "mes";
        }else if($meses > 1){
            $meses_desc = "meses";
        }

        if($dias == 0){
            $dias_desc = "";
            $dias = "";
        }else if($dias == 1){
            $dias_desc = "dia";
        }else if($dias > 1){
            $dias_desc = "dias";
        }        
    return $anios." ".$anios_desc." ".$meses." ".$meses_desc." ".$dias." ".$dias_desc;
    }
}
