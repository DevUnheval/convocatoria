<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsCambiosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_cambios_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('user_id');
            $table->string('campo', 50);
            $table->text('valor_anterior')->nullable();
            $table->text('valor_nuevo')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('fecha')->useCurrent();

            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->index('admin_id');
            $table->index('user_id');
            $table->index('fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs_cambios_usuarios');
    }
}
