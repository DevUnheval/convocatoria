<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRol;
use App\Proceso;
use App\Postulante;

class PruebaAbelTableSeeder extends Seeder
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
                'dni' => '70707070',
                'nombres' => 'HECTOR',
                'apellido_paterno' => 'VARGAS',
                'apellido_materno' => 'LLOSA',
                'email' => 'hector12@gmail.com',
            ],
            [
                'dni'=>'40404040',
                'nombres'=>"RICARDO",
                'apellido_paterno'=>'REYNOSO',
                'apellido_materno'=>'CADILLO',
                'email'=>'ricardo12@mail.com',
            ],
            [
                'dni'=>'50505050',
                'nombres'=>"ANTONIO",
                'apellido_paterno'=>'CESPEDES',
                'apellido_materno'=>'ROSA',
                'email'=>'sntonio12@mail.com',
            ],
            [
                'dni'=>'30303030',
                'nombres'=>"DENNYS",
                'apellido_paterno'=>'TUCTO',
                'apellido_materno'=>'RIOS',
                'email'=>'dennys12@mail.com',
            ],
            [
                'dni'=>'202020',
                'nombres'=>"RODRIGO",
                'apellido_paterno'=>'PEÑA',
                'apellido_materno'=>'NIETO',
                'email'=>'rodrigo12@mail.com',
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
        for($i=1;$i<=10;$i++){
            $query =new Proceso;
            $query->cod = 'CAS-00'.$i.'-2021';
            $query->tipo_id= ($i%5 + 1);
            $query->remuneracion=rand(930, 4005);;
            $query->especialidad='Especialidad '.$i;
            $query->nombre= 'Obstetricia';
            $query->descripcion = 'CONCURSO PÚBLICO VIRTUAL DE PLAZAS PARA DOCENTES Y JEFES DE PRCTICA CONTRATADOS 2021-I';
            $query->n_plazas = '3';
            $query->oficina = 'Docente - Jefe de Practica';
            $query->archivo_bases = 'no detectado';
            $query->archivo_bases_tipo = 'cv';
            $query->archivo_resolucion = 'link';
            $query->archivo_resolucion_tipo = 'link';
            $query->contrato_inicio = '2021-04-'.(9+$i);
            $query->evaluar_conocimientos = false;
            $query->hay_bon_pers_disc = true;
            $query->hay_bon_ffaa = true;
            $query->hay_bon_deport = false;
            $query->dias_exp_lab_gen = '0.5';
            $query->dias_exp_lab_esp = '0.5';
            $query->horas_cap_ind = '0.5';
            $query->fecha_aprobacion = '2021-03-22';
            $query->fecha_publicacion = '2021-03-29';
            $query->fecha_inscripcion_inicio = '2021-03-23';
            $query->fecha_inscripcion_fin = '2021-03-30';
            $query->fecha_resultados = '2021-04-02';
            $query->archivo_preliminar = 'dt';
            $query->archivo_preliminar_tipo = 'th';
            $query->save();
            unset($query);
        }
        for($i=1;$i<=10;$i++){
            $query =new Proceso;
            $query->cod = 'CAS-00'.$i.'-2021';
            $query->tipo_id= ($i%5 + 1);
            $query->remuneracion=rand(930, 4005);;
            $query->especialidad='Especialidad '.$i;
            $query->nombre= 'Ciencias Contables';
            $query->descripcion = 'CONCURSO PÚBLICO DE PLAZAS PARA DOCENTES CONTRATADOS 2021-I SEMESTRE PRIMERA CONVOCATORIA';
            $query->n_plazas = '3';
            $query->oficina = 'Docente';
            $query->archivo_bases = 'no detectado';
            $query->archivo_bases_tipo = 'cv';
            $query->archivo_resolucion = 'link';
            $query->archivo_resolucion_tipo = 'link';
            $query->contrato_inicio = '2021-04-'.(9+$i);
            $query->evaluar_conocimientos = false;
            $query->hay_bon_pers_disc = true;
            $query->hay_bon_ffaa = true;
            $query->hay_bon_deport = false;
            $query->dias_exp_lab_gen = '0.5';
            $query->dias_exp_lab_esp = '0.5';
            $query->horas_cap_ind = '0.5';
            $query->fecha_aprobacion = '2021-03-22';
            $query->fecha_publicacion = '2021-03-29';
            $query->fecha_inscripcion_inicio = '2021-03-23';
            $query->fecha_inscripcion_fin = '2021-03-30';
            $query->fecha_resultados = '2021-04-02';
            $query->archivo_preliminar = 'dt';
            $query->archivo_preliminar_tipo = 'th';
            $query->save();
            unset($query);
        }
        for($i=1;$i<=10;$i++){
            $query =new Proceso;
            $query->cod = 'CAS-00'.$i.'-2021';
            $query->tipo_id= ($i%5 + 1);
            $query->remuneracion=rand(930, 4005);;
            $query->especialidad='Especialidad '.$i;
            $query->nombre= 'Ingenieria Civil';
            $query->descripcion = 'CONCURSO PÚBLICO DE PLAZAS DOCENTES Y JEFES DE PRACTICA  PARA CONTRATADOS 2021-I SEMESTRE PRIMERA CONVOCATORIA';
            $query->n_plazas = '3';
            $query->oficina = 'Docentes-Jefes de Practica';
            $query->archivo_bases = 'no detectado';
            $query->archivo_bases_tipo = 'cv';
            $query->archivo_resolucion = 'link';
            $query->archivo_resolucion_tipo = 'link';
            $query->contrato_inicio = '2021-04-'.(9+$i);
            $query->evaluar_conocimientos = false;
            $query->hay_bon_pers_disc = true;
            $query->hay_bon_ffaa = true;
            $query->hay_bon_deport = false;
            $query->dias_exp_lab_gen = '0.5';
            $query->dias_exp_lab_esp = '0.5';
            $query->horas_cap_ind = '0.5';
            $query->fecha_aprobacion = '2021-03-22';
            $query->fecha_publicacion = '2021-03-29';
            $query->fecha_inscripcion_inicio = '2021-03-23';
            $query->fecha_inscripcion_fin = '2021-03-30';
            $query->fecha_resultados = '2021-04-02';
            $query->archivo_preliminar = 'dt';
            $query->archivo_preliminar_tipo = 'th';
            $query->save();
            unset($query);
        }

        //POSTULANTE
        foreach( User::where("id","<>",1)->get() as $key => $k){
            $query = new Postulante; 
            $query->user_id=$k->id;
            $query->proceso_id=1;
            $query->estado_pos=1;
            $query->email="notengocorreo22@mail.com";
            $query->save();
            unset($query);
        }
        


        
    }
    
}
