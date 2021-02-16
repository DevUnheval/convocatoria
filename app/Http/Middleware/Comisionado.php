<?php

namespace App\Http\Middleware;

use Closure;

class Comisionado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->hasRoles(['Administrador','Comisionado'])){
            return $next($request);

        }else{
          return  response('No puedes Continuar',403);
        }
    }
}
