<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacionPostulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacion_postulantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postulante_id');
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('cascade');
            $table->unsignedBigInteger('grado_id');
            $table->foreign('grado_id')->references('id')->on('grado_formacions')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_expedicion');
            $table->string('centro_estudios');
            $table->string('especialidad');
            $table->string('ciudad');
            $table->string('pais');
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
        Schema::dropIfExists('formacion_postulantes');
    }
}
