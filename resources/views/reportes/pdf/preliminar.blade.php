@extends('reportes.pdf.plantilla')
@section('contenido')

<br> 
@foreach($proceso as $key2=>$p)
<h5 style="text-align:center; margin:0;padding:0;">Proceso de concurso {{$p->cod}} - ( {{$p->n_plazas}} plazas)</h5>
<h5 style="text-align:center; margin:0;padding:0;">NOMBRE DE LA CONVOCATORIA: {{$p->nombre}} </h5><br>

<h5 align="center" style="margin:0;padding:0;color:blue;text-transform: uppercase;">PUBLICACIÓN DE RESULTADOS DE EVALUACIÓN PRELIMINAR</h5><br>
<table class="tabla-reporte">
        <thead >
            <tr  >
                <th rowspan="2"  border="1">Nº</th>
                <th rowspan="2">Celular</th>
                <th rowspan="2">Apellidos y Nombres</th>     
                <th colspan="2">Resultado</th>
                                                           
            </tr>
            <tr>
                <th>Califica</th>
                <th>No Califica</th>                                                
            </tr>
        </thead>
        <tbody>   
            @foreach($data[$key2] as $key => $p)    
            <tr>
                <td align="center">
                        {{($key+1)}}
                </td>
                <td align="center">{{($p->telefono_celular)}} </td>
                <td>{{$p->nombres}}</td>  
                <td align="center">
                        x
                </td>  
                <td align="center">
                </td>                                                
            </tr> 
            @endforeach     
            @if(count($data) < 1 )
            <tr>
                <td align="center" colspan="5"><i> No hay postulantes </i></td>
            </tr>
            @endif                           
        </tbody>                                            
</table> 
<div class="page-break"></div>
@endforeach 

@endsection