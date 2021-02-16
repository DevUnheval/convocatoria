<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaLabPostulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_lab_postulantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postulante_id');
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('cascade');
            //tipo--> solo puede ser ambos
            $table->boolean('es_exp_gen')->default(true);
            $table->boolean('es_exp_esp')->default(false);
            //Tipo institución/centro laboral: 0: publico, 1: privado
            $table->string('tipo_institucion');
            // tipo experiencia 1: Regular; 2: practicas pre prof; 3: practicas profeionales;
            $table->integer('tipo_experiencia');
            //datos generales-obligatorios
            $table->string('centro_laboral');//nombre de la entidad o empresa
            $table->string('cargo_funcion');
            $table->string('desc_cargo_funcion')->nullable();//descripcion del cargo funcion
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('dias_exp_gen');
            $table->integer('dias_exp_esp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiencia_lab_postulantes');
    }
}
