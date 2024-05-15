@extends('reportes.pdf.plantilla')
@section('contenido')

<br> 
@foreach($data["proceso_enca"] as $key2=>$p)
<h5 style="text-align:center; margin:0;padding:0;">Proceso de concurso {{$p->cod}} </h5>
<h5 style="text-align:center; margin:0;padding:0;">NOMBRE DE LA CONVOCATORIA: {{$p->nombre}} - ({{$p->n_plazas}} plazas)</h5><br>
<h5 align="center" style="margin:0;padding:0;color:blue;text-transform: uppercase;">PUBLICACIÓN DEL RESULTADO FINAL</h5><br>


<table class="tabla-reporte" {{sizeof($data['postu']) == 7 ? 'small' : ''}}">
                <?php 
                    //$colums = 12;
                    //$colum = 3;
                    //foreach($data["proceso_enca"] as $key2=>$p){
                    $colums = 12;
                    $colum = 3;
                    $formula = "A*".$p->peso_cv." + B*".$p->peso_conoc." + C".$p->peso_entrev;
                    if(! (boolean)$p->evaluar_conocimientos){$colums--; $colum--; $formula = "A*".$p->peso_cv." + C*".$p->peso_entrev;}
                    // if(! (boolean)$data['proceso_enca']->hay_bon_pers_disc) $colums--;
                    // if(! (boolean)$data['proceso_enca']->hay_bon_ffaa) $colums--;
                    // if(! (boolean)$data['proceso_enca']->hay_bon_deport) $colums--;
                	//}
                ?>
                <thead>
                	
                    <tr>
                        <th rowspan="2"  border="1">Orden de Mérito</th>
                        <th rowspan="2"  border="1">DNI</th>
                        <th rowspan="2" style="width:50px;">APELLIDOS Y NOMBRES</th>            
                        <th colspan="{{$colum}}">EVALUACION</th>
                        <th rowspan="2"  border="1">PT = PUNTAJE TOTAL ({{$formula}})</th>
                        
                        <!-- <th rowspan="2"  border="1">BONIFICACIÓN LIC. FFAA ({{$p->bon_ffaa}}*C) </th> -->

                        <th rowspan="2"  border="1">BONIFICACIÓN LIC. FFAA ({{$p->bon_ffaa}}*PT) </th> 
                       
                        <!-- <th rowspan="2"  border="1">BONIFICACIÓN PERS. DISCAPACIDAD ({{$p->bon_pers_disc}}*C)</th> -->
                        
                        <th rowspan="2"  border="1">BONIFICACIÓN PERS. DISCAPACIDAD ({{$p->bon_pers_disc}}*PT)</th>
                        
                        <!-- <th rowspan="2"  border="1">BONIFICACIÓN DEPORTISTA CALIFICADO (n*C)</th> -->

                        <th rowspan="2"  border="1">BONIFICACIÓN DEPORTISTA CALIFICADO (n*PT)</th>
                       
                        <th rowspan="2"  border="1">PF = PUNTAJE FINAL (PT + Bonificaciones)</th>
                        <th rowspan="2"  border="1">CONDICION</th>
                        <th rowspan="2"  border="1">OBSERVACIÓN</th>
                    </tr>
                    <tr>
                        <th>A = CURICULAR</th>
                        @if( (boolean)$p->evaluar_conocimientos)
                        <th>B = CONOCIMIENTO</th> 
                        @endif
                        <th>C = ENTREVISTA</th>                                                
                    </tr>
                </thead>
                <tbody>   
                    @foreach($data["postu"][$key2] as $key => $p)     
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
                        
                        <td align="center">{{ (float) $p->bonific_ffaa}}</td>  
                        
                        
                        <td align="center">{{ (float) $p->bonific_pers_disc}}</td>  
                        
                        <td align="center">{{ (float) $p->bonific_deportista}}</td>
                        
                        <td align="center">{{ (float) $p->final}}</td> 
                        <td align="center">{{  $p->condicion}}</td>
                        <td align="center">{{  $p->obs_entrevista}}</td>                   
                    </tr> 
                    @endforeach     
                    @if(count($data["postu"]) < 1 )
                    <tr>
                        <td align="center" colspan="{{$colums}}"><i> No hay datos para mostrar </i></td>
                    </tr>
                    @endif                           
                </tbody>
                                                    
        </table>  
       
        <small style="font-size:10px"><i>*n = % variable según los méritos del deportista calificado</i></small>
<div class="page-break"></div>        
 @endforeach 

@endsection