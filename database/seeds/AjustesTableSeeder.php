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
                  'username' => 'Administrador',
                  'nombres' => 'Administrador',
                  'apellido_paterno' => 'paterno',
                  'apellido_materno' => 'materno',
                  'email' => 'email@mail.com',
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
              // [
              //     'user_id' => '2',
              //     'rol_id' => '2',
              // ]
           ]);
  
    }
}
