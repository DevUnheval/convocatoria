<?php

namespace App\Http\Middleware;

use Closure;

class GestionConvocatoria
{
    /**
     * Handle an incoming request.
     * Permite Administrador, Comisionado y Operador gestionar convocatorias
     * (crear, editar, publicar comunicados/evaluación/resultados).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->hasRoles(['Administrador', 'Comisionado', 'Operador'])) {
            return $next($request);
        }

        return response('No puedes Continuar', 403);
    }
}
