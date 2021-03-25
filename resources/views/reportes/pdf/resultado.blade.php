@extends('reportes.pdf.plantilla')
@section('contenido')

<br> 
<h5 style="text-align:center; margin:0;padding:0;">Proceso de concurso {{$data["proceso"]->cod}} </h5>
<h5 style="text-align:center; margin:0;padding:0;">NOMBRE DE LA CONVOCATORIA: {{$data["proceso"]->nombre}} - ({{$data["proceso"]->n_plazas}} plazas)</h5><br>
<h5 align="center" style="margin:0;padding:0;color:blue;text-transform: uppercase;">PUBLICACIÓN DEL RESULTADO FINAL</h5><br>


<table class="tabla-reporte">
                <?php 
                    $colums = 12;
                    $colum = 3;
                    $formula = "A*".$data['proceso']->peso_cv." + B*".$data['proceso']->peso_conoc." + C".$data['proceso']->peso_entrev;
                    if(! (boolean)$data['proceso']->evaluar_conocimientos){$colums--; $colum--; $formula = "A*".$data['proceso']->peso_cv." + B*".$data['proceso']->peso_entrev;}
                    if(! (boolean)$data['proceso']->hay_bon_pers_disc) $colums--;
                    if(! (boolean)$data['proceso']->hay_bon_ffaa) $colums--;
                    if(! (boolean)$data['proceso']->hay_bon_deport) $colums--;
                ?>
                <thead>
                    <tr>
                        <th rowspan="2"  border="1">Orden de Mérito</th>
                        <th rowspan="2"  border="1">DNI</th>
                        <th rowspan="2" style="width:50px;">APELLIDOS Y NOMBRES</th>            
                        <th colspan="{{$colum}}">EVALUACION</th>
                        <th rowspan="2"  border="1">PT = PUNTAJE TOTAL ({{$formula}})</th>
                        @if( (boolean)$data['proceso']->hay_bon_ffaa)
                        <th rowspan="2"  border="1">BONIFICACIÓN LIC. FFAA ({{$data['proceso']->bon_ffaa}}*PT) </th>
                        @endif
                        @if( (boolean)$data['proceso']->hay_bon_pers_disc)
                        <th rowspan="2"  border="1">BONIFICACIÓN PERS. DISCAPACIDAD ({{$data['proceso']->bon_pers_disc}}*PT)</th>
                        @endif
                        @if( (boolean)$data['proceso']->hay_bon_deport)
                        <th rowspan="2"  border="1">BONIFICACIÓN DEPORTISTA CALIFICADO ({{$data['proceso']->bon_deport}}*PT)</th>
                        @endif
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
                        @if( (boolean)$data['proceso']->hay_bon_pers_disc)
                        <td align="center">{{ (float) $p->bonific_pers_disc}}</td>  
                        @endif
                        @if( (boolean)$data['proceso']->hay_bon_deport)
                        <td align="center">{{ (float) $p->bonific_deportista}}</td>
                        @endif
                        <td align="center">{{ (float) $p->final}}</td> 
                        <td align="center">{{  $p->condicion}}</td>                
                    </tr> 
                    @endforeach     
                    @if(count($data["postulantes"]) < 1 )
                    <tr>
                        <td align="center" colspan="{{$colums}}"><i> No hay datos para mostrar </i></td>
                    </tr>
                    @endif                           
                </tbody>                                       
        </table>  


@endsection