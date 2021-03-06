<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_procesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proceso_id');
            $table->foreign('proceso_id')->references('id')->on('procesos')->onDelete('cascade');
            $table->string('nombre')->nullable();
            $table->string('archivo');
            $table->string('archivo_tipo')->default('local'); //local o web
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
        Schema::dropIfExists('evaluacion_procesos');
    }
}
