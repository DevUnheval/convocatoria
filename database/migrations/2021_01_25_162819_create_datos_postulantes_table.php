<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPostulantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_postulantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postulante_id');
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('cascade');

            $table->string('archivo_dni');
            $table->string('archivo_dni_tipo');

            //contacto
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->string('ruc')->nullable();

            //domicilio
            $table->string('domicilio');
            $table->string('ubigeo_domicilio'); //no le pongo como llave primaria, xq el ubigeo lo es
            $table->date('fecha_nacimiento')->nullable();
            $table->string('ubigeo_nacimiento')->nullable();//quizá lo quitemos
            $table->string('nacionalidad')->default('Peruana');//quizá lo quitemos

            //bonificacion
            $table->boolean('es_pers_disc')->default(false);
            $table->string('archivo_disc')->nullable();
            $table->string('archivo_disc_tipo')->nullable();

            $table->boolean('es_lic_ffaa')->default(false);
            $table->string('archivo_ffaa')->nullable();
            $table->string('archivo_ffaa_tipo')->nullable();
            
            $table->boolean('es_deportista')->default(false);
            $table->string('archivo_deport')->nullable();
            $table->string('archivo_deport_tipo')->nullable();
            
            $table->boolean('es_otros1')->default(false);
            $table->string('archivo_otro')->nullable();
            $table->string('archivo_otro_tipo')->nullable();
            
            $table->boolean('es_otros2')->default(false);
            $table->string('archivo_otro2')->nullable();
            $table->string('archivo_otro2_tipo')->nullable();

            //declaracion 
            $table->boolean('dj1')->default(true);
            $table->boolean('dj2')->default(true);
            $table->boolean('dj3')->default(true);
            $table->boolean('dj4')->default(true);
            $table->boolean('dj5')->default(true);
            $table->boolean('dj6')->default(true);
            $table->boolean('dj7')->default(true);
            $table->boolean('dj8')->default(true);
            $table->boolean('dj9')->default(true);
            $table->boolean('dj10')->default(true);
            $table->boolean('dj11')->default(true);
            $table->string('archivo1')->nullable(); //algun archivo que pudiera evideciar o justificar algo. P.e grado de consaguinidad
            $table->string('archivo1_tipo')->nullable();
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
        Schema::dropIfExists('datos_postulantes');
    }
}
