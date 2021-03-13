<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaLabUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_lab_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //tipo-->check box, puede marcarse ambos
            $table->boolean('es_exp_gen')->default(true);
            $table->boolean('es_exp_esp')->default(false);
            //Tipo institución/centro laboral: 0: publico, 1: privado
            $table->string('tipo_institucion');
            // tipo experiencia 1: Regular; 2: practicas pre prof; 3: practicas profeionales;
            $table->integer('tipo_experiencia');
            //datos generales-obligatorios
            $table->string('centro_laboral');//nombre de la entidad o empresa
            $table->string('cargo_funcion');
            $table->string('desc_cargo_funcion','1000')->nullable();//descripcion del cargo funcion
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('num_pag');//numero de pagina donde señala inicio y fin de la experiencia
            $table->integer('dias_exp_gen');
            $table->integer('dias_exp_esp');
            $table->string('archivo');
            $table->string('archivo_tipo');
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
        Schema::dropIfExists('experiencia_lab_users');
    }
}
