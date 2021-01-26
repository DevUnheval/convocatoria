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
            //tipo--> solo puede ser ambos
            $table->boolean('es_exp_gen')->default(true);
            $table->boolean('es_exp_esp')->default(false);
            //datos generales-obligatorios
            $table->string('centro_laboral');//nombre de la entidad o empresa
            $table->string('cargo_funcion');
            $table->string('desc_cargo_funcion')->nullable();//descripcion del cargo funcion
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('dias_exp_gen', 5, 2)->nullable(); 
            $table->decimal('dias_exp_esp', 5, 2)->nullable(); 
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
