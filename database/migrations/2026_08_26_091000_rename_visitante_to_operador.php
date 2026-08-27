<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameVisitanteToOperador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('rols')
            ->where('nombre', 'Visitante')
            ->update([
                'nombre' => 'Operador',
                'descripcion' => 'Puede crear y editar convocatorias, y publicar comunicados, evaluación y resultados',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('rols')
            ->where('nombre', 'Operador')
            ->update([
                'nombre' => 'Visitante',
                'descripcion' => 'Usuario por defecto, puede solo ver los resultados',
            ]);
    }
}
