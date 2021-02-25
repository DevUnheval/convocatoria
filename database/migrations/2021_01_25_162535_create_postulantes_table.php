<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('proceso_id');
            $table->foreign('proceso_id')->references('id')->on('procesos')->onDelete('cascade');
            //evaluaciones
            $table->decimal('ev_curricular', 5, 2)->nullable();//puntaje p.e 10, 30, 90 
            $table->boolean('cal_curricular')->nullable();//Calificación curricular: Califica - No Califica
            $table->decimal('ev_conocimiento', 5, 2)->nullable();
            $table->boolean('cal_conocimientos')->nullable();//Calificación curricular: Califica - No Califica
            $table->decimal('ev_entrevista', 5, 2)->nullable();
            $table->boolean('cal_entrevista')->nullable();//Calificación curricular: Califica - No Califica
            $table->decimal('bonificacion', 5, 2)->nullable();
            $table->decimal('total', 5, 2)->nullable();
            $table->boolean('estado_pos')->default(false);//para evaluar si ya esta postulando o no

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
        Schema::dropIfExists('postulantes');
    }
}
