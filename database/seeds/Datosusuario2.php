<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Datosusuario2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('datos_users')->insert([
            'user_id' => '2',
            'archivo_dni' => '#',
            'archivo_dni_tipo' => 'local',
            'domicilio' => 'Jr dos de mayo 2021',
            'ubigeo_domicilio' => '90101',
            'nacionalidad' => 'Peruano(a)',
            'ubigeo_nacimiento' => '90101',
    ]);
    DB::table('datos_postulantes')->insert([
        'postulante_id' => '1',
        'archivo_dni' => '#',
        'archivo_dni_tipo' => 'local',
        'domicilio' => 'Jr dos de mayo 2021',
        'ubigeo_domicilio' => '90101',
        'nacionalidad' => 'Peruano(a)',
        'ubigeo_nacimiento' => '90101',
]);
    
    }
}
