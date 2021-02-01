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
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_procesos')->onDelete('cascade');

            //datos generales
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->string('n_plazas')->default(1);
            $table->string('oficina')->nullable();
            $table->string('archivo_bases')->nullable(); //link local, o URL de drive
            $table->string('archivo_bases_tipo')->nullable(); //local o web
            $table->string('archivo_resolucion')->nullable(); //link local, o URL de drive
            $table->string('archivo_resolucion_tipo')->nullable();//local o web
            $table->date('contrato_inicio')->nullable();

            //configuración
            $table->boolean('evaluar_conocimientos')->default(false); //true or false
            $table->decimal('bon_ffaa', 3, 2)->default(0.1);
            $table->decimal('bon_pers_disc', 3, 2)->default(0.15);
            $table->decimal('bon_deport', 3, 2)->default(0);
            $table->decimal('bon_otros1', 3, 2)->default(0);
            $table->decimal('bon_otros2', 3, 2)->default(0);

            //$table->decimal('pje_otro', 3, 2)->default(0);
            $table->decimal('pje_max_cv', 4, 2)->default(60.00);
            $table->decimal('pje_min_cv', 4, 2)->default(40.00);
            $table->decimal('pje_max_conoc', 5, 2)->default(0);
            $table->decimal('pje_min_conoc', 5, 2)->default(0);
            $table->decimal('pje_max_entrev', 5, 2)->default(40);
            $table->decimal('pje_min_entrev', 5, 2)->default(20);
                //CV
                $table->decimal('anios_exp_lab_gen', 5, 2)->default(3);
                $table->decimal('anios_exp_lab_esp', 5, 2)->default(2);
                $table->decimal('horas_cap_total', 5, 2)->default(0);
                $table->decimal('horas_cap_ind', 5, 2)->default(0);

            //Cronograma
            $table->date('fecha_aprobacion')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->dateTimeTz('fecha_inscripcion_inicio')->nullable();
            $table->dateTimeTz('fecha_inscripcion_fin')->nullable();
            $table->date('fecha_resultados')->nullable();


            //archivos/publicaciones
            $table->string('archivo_preliminar')->nullable();
            $table->string('archivo_preliminar_tipo')->nullable();
                //evaluaciones=> es una tabla aparte, 
            $table->string('archivo_resultado')->nullable();
            $table->string('archivo_resultado_tipo')->nullable();

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
