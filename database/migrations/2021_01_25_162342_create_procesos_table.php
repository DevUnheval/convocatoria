<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();
            $table->string('cod'); //1,2,3 cada año se reinicia
            $table->integer('etapa_evaluacion')->default(1);//1: CV, 2: Conoc; 3: entrevista
            $table->integer('estado')->default(1); // 0: pre-cargado, 1: publicado, 2: en curso, 3: concluido, 4: cancelado 
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_procesos')->onDelete('cascade');

            //datos generales
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->string('n_plazas')->default(1);
            $table->string('oficina')->nullable();
            $table->text('habilidades')->nullable();
            $table->text('capacitaciones')->nullable();
            $table->decimal('remuneracion', 7, 2)->nullable();
            $table->string('especialidad')->default("Ninguna");
            
            $table->string('archivo_bases')->nullable(); //link local, o URL de drive
            $table->string('archivo_bases_tipo')->default('local'); //local o web
            $table->string('archivo_resolucion')->nullable(); //link local, o URL de drive
            $table->string('archivo_resolucion_tipo')->default('local');//local o web
            $table->date('contrato_inicio')->nullable();

            //configuración
            $table->boolean('evaluar_conocimientos')->default(false); //true or false
            $table->decimal('bon_ffaa', 3, 2)->default(0.1);
            $table->decimal('bon_pers_disc', 3, 2)->default(0.15);
            $table->decimal('bon_deport', 3, 2)->default(0);
            $table->decimal('bon_otros1', 3, 2)->default(0);
            $table->decimal('bon_otros2', 3, 2)->default(0);
            
            $table->boolean('hay_bon_pers_disc')->default(true);
            $table->boolean('hay_bon_ffaa')->default(true);
            $table->boolean('hay_bon_deport')->default(false);
                //nivel-grado academico a convocar
                $table->integer('nivel_acad_convocar')->default(1);
                //nivel-grado academico a evaluar
                $table->integer('nivel_acad_evaluar')->default(1);
                $table->string('especialiad')->nullable(); 
                //considerar o no practicas preprofesionales y profesionales
                $table->boolean('consid_prac_preprof')->default(1);
                $table->boolean('consid_prac_prof')->default(1);	

            //$table->decimal('pje_otro', 3, 2)->default(0);
            $table->decimal('pje_max_cv', 4, 2)->default(60.00);
            $table->decimal('pje_min_cv', 4, 2)->default(40.00);
            $table->decimal('pje_max_conoc', 5, 2)->default(0);
            $table->decimal('pje_min_conoc', 5, 2)->default(0);
            $table->decimal('pje_max_entrev', 5, 2)->default(40);
            $table->decimal('pje_min_entrev', 5, 2)->default(20);
            $table->decimal('peso_cv', 4, 2)->default(0.0);
            $table->decimal('peso_conoc', 4, 2)->default(0.0);
            $table->decimal('peso_entrev', 4, 2)->default(0.0);
                //CV
                $table->integer('anios_exp_lab_gen')->default(0);
                $table->integer('anios_exp_lab_esp')->default(0);
                $table->integer('horas_cap_total')->default(0); //cambiado a integer
                $table->integer('horas_cap_ind')->default(0); //cambiado a integer

            //Cronograma
            $table->date('fecha_aprobacion')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->dateTimeTz('fecha_inscripcion_inicio')->nullable();
            $table->dateTimeTz('fecha_inscripcion_fin')->nullable();
            $table->date('fecha_resultados')->nullable();
            $table->date('fecha_firma_contrato')->nullable();
            $table->string('duracion_contrato')->nullable();


            //archivos/publicaciones
            $table->string('archivo_preliminar')->nullable();
            $table->string('archivo_preliminar_tipo')->default('local');
                //evaluaciones=> es una tabla aparte, 
            $table->string('archivo_resultado')->nullable();
            $table->string('archivo_resultado_tipo')->nullable('local');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procesos');
    }
}
