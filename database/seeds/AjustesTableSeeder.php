<?php

use Illuminate\Database\Seeder;
use App\Ajuste;
use Illuminate\Support\Facades\DB;

class AjustesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ajustes = app(\App\Http\Controllers\AjustesController::class);
        $ajustes = $ajustes->data();  // Get attributes from DB
            
            foreach($ajustes as $a){ 
              $temp = new Ajuste; 
              $temp->nombre = $a['nombre']; 
              $temp->valor = $a['valor']; 
              $temp->descripcion = $a['descripcion'];
              $temp->tipo = $a['tipo']; 
              $temp->save();
              unset($temp); 
            }
        
            DB::table('users')->insert([
              [
                  'dni' => 'Administrador',
                  'nombres' => 'Administrador',
                  'apellido_paterno' => 'paterno',
                  'apellido_materno' => 'materno',
                  'email' => 'email@mail.com',
                  'email_verified_at' => date('2021-01-31 22:12:03'),
                  'password' => bcrypt('Administrador'),
              ],
           ]);

           DB::table('users')->insert([
            [
                'dni' => '12345678',
                'nombres' => 'CESAR',
                'apellido_paterno' => 'JIMENEZ',
                'apellido_materno' => 'VARGAS',
                'email' => 'email2@gmail.com',
                'email_verified_at' => '2021-01-31 22:12:03',
                'password' => bcrypt('12345678'),
            ],
         ]);
         
           DB::table('rols')->insert([
              [
                  'nombre' => 'Administrador',
                  'descripcion' => 'Todo lo ve, todo lo sabe',
              ],
              [
                  'nombre' => 'Comisionado',
                  'descripcion' => 'Puede evaluar a los participantes',
              ],
              [
                'nombre' => 'Editor',
                'descripcion' => 'Puede crear convocatorias',
              ],
              [
                  'nombre' => 'Postulante',
                  'descripcion' => 'Puede postular a una plaza',
              ],
              [
                  'nombre' => 'Visitante',
                  'descripcion' => 'Usuario por defecto, puede solo ver los resultados',
              ]
           ]);
  
           DB::table('user_rols')->insert([
              [
                  'user_id' => '1',
                  'rol_id' => '1',
              ],
           ]);

           DB::table('user_rols')->insert([
            [
                'user_id' => '2',
                'rol_id' => '3',
            ],
         ]);

           DB::table('tipo_procesos')->insert([
            [
                'nombre' => 'C.A.S',
                'descripcion' => 'desc',
            ],
            [
                'nombre' => '728',
                'descripcion' => 'desc 728',
            ],
            [
                'nombre' => 'Servir',
                'descripcion' => 'servir',
            ],
            [
                'nombre' => 'Practicas pre Profesionales',
                'descripcion' => 'descripcion',
            ],
            [
                'nombre' => 'Practicas Profesionales',
                'descripcion' => 'descripcion',
            ],            
         ]);

         DB::table('grado_formacions')->insert([
            [
                'nombre' => 'Tecnico Profesional',
                'descripcion' => 'desc',
            ],
            [
                'nombre' => 'Bachiller',
                'descripcion' => 'desc',
            ],
            [
                'nombre' => 'Título Profesional',
                'descripcion' => 'desc',
            ],
            [
                'nombre' => 'Posgrado Maestria',
                'descripcion' => 'descripcion',
            ],
            [
                'nombre' => 'Posgrado Doctorado',
                'descripcion' => 'descripcion',
            ],            
         ]);
         

  
    }
}
