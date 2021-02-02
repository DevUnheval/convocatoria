<?php

use Illuminate\Database\Seeder;
use App\Ajuste;
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
                  'email_verified_at' => date('Y-m-d'),
                  'password' => bcrypt('Administrador'),
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
