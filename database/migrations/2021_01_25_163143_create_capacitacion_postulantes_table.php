<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacitacionPostulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitacion_postulantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postulante_id');
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('cascade');
            //tipo--> solo puede ser uno de ellos, no debe estar marcado más de uno
            $table->boolean('es_curso_espec')->default(false);
            $table->boolean('es_ofimatica')->default(false);
            $table->boolean('es_idioma')->default(false);
            //datos generales-obligatorios
            $table->string('centro_estudios');
            $table->string('especialidad');
            $table->string('ciudad');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('pais');
            $table->string('archivo');
            $table->string('archivo_tipo');
            //$table->decimal('cantidad_horas', 5, 2)->nullable();
            $table->integer('cantidad_horas');
            //Nivel.-si es idiomas o ofimatica
            $table->string('nivel')->nullable(); //básico,intermedio, avanzado
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
        Schema::dropIfExists('capacitacion_postulantes');
    }
}
