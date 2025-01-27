<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRol;
use App\Proceso;
use App\Postulante;

class PruebaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users=[
            [
                'dni' => '12345678',
                'nombres' => 'CESAR',
                'apellido_paterno' => 'JIMENEZ',
                'apellido_materno' => 'VARGAS',
                'email' => 'email2@gmail.com',
            ],
            [
                'dni'=>'12121236',
                'nombres'=>"Pepito Postulante",
                'apellido_paterno'=>'Cardenas',
                'apellido_materno'=>'Educardo',
                'email'=>'12121236@mail.com',
            ],
            [
                'dni'=>'12121555',
                'nombres'=>"Lucio Ponce",
                'apellido_paterno'=>'Wilson',
                'apellido_materno'=>'Chavez',
                'email'=>'12121555@mail.com',
            ],
            [
                'dni'=>'48315656',
                'nombres'=>"Eduardo Percy",
                'apellido_paterno'=>'Washinton',
                'apellido_materno'=>'Culantres',
                'email'=>'48315656@mail.com',
            ],
        ];

               
        //USUARIOS y ROLES
        foreach($users as $u){
            $query = new User;
            $query->dni=$u['dni'];
            $query->nombres=strtoupper($u['nombres']);
            $query->apellido_paterno=strtoupper($u['apellido_paterno']);
            $query->apellido_materno=strtoupper($u['apellido_materno']);
            $query->email= $u['email'];
            $query->email_verified_at= date("Y-m-d");
            $query->password=bcrypt($u['dni']);
            $query->save();
            
            $query2 = new UserRol;
            $query2->user_id = $query->id;
            $query2->rol_id = 4;
            $query2->save();
            unset($query);
            unset($query2);

        }
        
        //PROCESO
        for($i=1;$i<=5;$i++){
            $query =new Proceso;
            $query->cod = 'CAS-00'.$i.'-2020';
            $query->tipo_id= ($i%5 + 1);
            $query->remuneracion=rand(930, 4005);;
            $query->especialidad='Especialidad '.$i;
            $query->nombre= 'Ingeniero de Sistemas';
            $query->descripcion = 'La Oficina de informática requiere Ingeniero de sistemas cobn expiericia en desarrollo de SW';
            $query->n_plazas = $i%3+1;
            $query->oficina = 'Unidad de informática';
            $query->archivo_bases = 'no detectado';
            $query->archivo_bases_tipo = 'cv';
            $query->archivo_resolucion = 'link';
            $query->archivo_resolucion_tipo = 'link';
            $query->contrato_inicio = '2019-03-'.(9+$i);
            $query->evaluar_conocimientos = false;
            $query->hay_bon_pers_disc = true;
            $query->hay_bon_ffaa = true;
            $query->hay_bon_deport = false;
            $query->dias_exp_lab_gen = '365';
            $query->dias_exp_lab_esp = '365';
            $query->horas_cap_ind = '24';
            $query->fecha_aprobacion = '2021-03-23';
            $query->fecha_publicacion = '2021-03-25';
            $query->fecha_inscripcion_inicio = '2021-03-25';
            $query->fecha_inscripcion_fin = '2021-03-30';
            $query->fecha_resultados = '2021-04-10';
            $query->save();
            unset($query);
        }

        //POSTULANTE
        foreach( User::where("id","<>",1)->get() as $key => $k){
            $query = new Postulante; 
            $query->user_id=$k->id;
            $query->proceso_id=1;
            $query->estado_pos=1;
            $query->email="notengocorreo@mail.com";
            $query->save();
            unset($query);
        }
        


        
    }
}
