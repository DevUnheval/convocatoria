<?php

namespace App\Http\Middleware;

use Closure;

class Postulante
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
        if(auth()->user()->hasRoles(['Postulante'])){
            return $next($request);

        }else{
          return  response('No puedes Continuar',403);
        }
    }
}
