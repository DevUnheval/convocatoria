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
            $table->text('obs_curricular')->nullable();
            $table->decimal('ev_conocimiento', 5, 2)->nullable();
            $table->boolean('cal_conocimientos')->nullable();//Calificación curricular: Califica - No Califica
            $table->text('obs_conocimientos')->nullable();
            $table->decimal('ev_entrevista', 5, 2)->nullable();
            $table->boolean('cal_entrevista')->nullable();//Calificación curricular: Califica - No Califica
            $table->text('obs_entrevista')->nullable();
            $table->decimal('bonificacion', 5, 2)->nullable();//eliminar este campo
            $table->decimal('bonific_deportista', 5, 2)->nullable();
            $table->decimal('bonific_ffaa', 5, 2)->nullable();
            $table->decimal('bonific_pers_disc', 5, 2)->nullable();
            $table->decimal('total', 5, 2)->nullable();
            $table->boolean('estado_pos')->default(false);//para evaluar si ya esta postulando o no y enviar la constancia al correo
            $table->string('email');//correo al cual se está enviando la constancia de postulación

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
