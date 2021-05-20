<!DOCTYPE html>
<html>
    <head>
        <title>Reporte CONVOCATORIA XYZ</title>
    </head>
    
 <style>
    .tabla-reporte  td, .tabla-reporte  th {
        padding:5px;
        border: 1px solid black;
        font-size: 12px;
    }
    .tabla-reporte  th {
        font-weight: bold;
        text-align: center;
        background-color: rgba(234, 237, 237, .6 )
    }
    
    .tabla-reporte {
        width: 100%;
        border-collapse: collapse;
        border:  blue 1px solid;
    }
</style>
    <body>
    
        <table class="tabla-reporte">
                <?php 
                    $colums = 12;
                    $colum = 3;
                    $formula = "A*".$data['proceso']->peso_cv." + B*".$data['proceso']->peso_conoc." + C".$data['proceso']->peso_entrev;
                    if(! (boolean)$data['proceso']->evaluar_conocimientos){$colums--; $colum--; $formula = "A*".$data['proceso']->peso_cv." + C*".$data['proceso']->peso_entrev;}
                    // if(! (boolean)$data['proceso']->hay_bon_pers_disc) $colums--;
                    // if(! (boolean)$data['proceso']->hay_bon_ffaa) $colums--;
                    // if(! (boolean)$data['proceso']->hay_bon_deport) $colums--;
                ?>
                <thead>
                    <tr>
                        <td  align="center" colspan="{{$colums}}">
                            <h1>Proceso de concurso {{$data["proceso"]->cod}} 
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="{{$colums}}" ><h2>NOMBRE DE LA CONVOCATORIA: {{$data["proceso"]->nombre}}  -  Nº DE PLAZAS: {{$data['proceso']->n_plazas}}</h2></td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="{{$colums}}"><h3>PUBLICACIÓN DEL RESULTADO FINAL</h3></td>
                    </tr>
                    <tr>
                        <th rowspan="2"  border="1">Orden de Mérito</th>
                        <th rowspan="2"  border="1">DNI</th>
                        <th rowspan="2" style="width:50px;">APELLIDOS Y NOMBRES</th>            
                        <th colspan="{{$colum}}">EVALUACION</th>
                        <th rowspan="2"  border="1">PT = PUNTAJE TOTAL ({{$formula}})</th>
      
                        <th rowspan="2"  border="1">BONIFICACIÓN LIC. FFAA ({{$data['proceso']->bon_ffaa}}*C) </th>

                        <th rowspan="2"  border="1">BONIFICACIÓN PERS. DISCAPACIDAD ({{$data['proceso']->bon_pers_disc}}*C)</th>
       
                        <th rowspan="2"  border="1">BONIFICACIÓN DEPORTISTA CALIFICADO ({{$data['proceso']->bon_deport}}*C)</th>
                        
                        <th rowspan="2"  border="1">PF = PUNTAJE FINAL (PT + Bonificaciones)</th>
                        <th rowspan="2"  border="1">CONDICION</th>
                    </tr>
                    <tr>
                        <th>A = CURICULAR</th>
                        @if( (boolean)$data['proceso']->evaluar_conocimientos)
                        <th>B = CONOCIMIENTO</th> 
                        @endif
                        <th>C = ENTREVISTA</th>                                                
                    </tr>
                </thead>
                <tbody>   
                    @foreach($data["postulantes"] as $key => $p)    
                    <tr>
                        <td align="center">
                                {{($key+1)}}
                        </td>
                        <td align="center">{{($p->dni)}} </td>
                        <td>{{$p->nombres}}</td>  
                        <td align="center">{{ (float) $p->ev_curricular}}</td>  
                        @if( (boolean)$data['proceso']->evaluar_conocimientos)
                        <td align="center">{{ (float) $p->ev_conocimiento}}</td> 
                        @endif
                        <td align="center">{{ (float) $p->ev_entrevista}}</td>  
                        <td align="center">{{$p->total}}</td>
                        @if( (boolean)$data['proceso']->hay_bon_ffaa)
                        <td align="center">{{ (float) $p->bonific_ffaa}}</td>  
                        @endif
                        
                        <td align="center">{{ (float) $p->bonific_pers_disc}}</td>  
                        
                        <td align="center">{{ (float) $p->bonific_deportista}}</td>
                       
                        <td align="center">{{ (float) $p->final}}</td> 
                        <td align="center">{{  $p->condicion}}</td>                  
                    </tr> 
                    @endforeach     
                    @if(count($data) < 1 )
                    <tr>
                        <td align="center" colspan="{{$colums}}"><i> No hay postulantes </i></td>
                    </tr>
                    @endif                           
                </tbody>                                       
        </table>  <small style="font-size:10px"><i>*n = % variable según los méritos del deportista calificado</i></small>
    </body>
</html>

