@extends('reportes.pdf.plantilla')
@section('contenido')

<br> 
<h5 style="text-align:center; margin:0;padding:0;">Proceso de concurso {{$data["proceso"]->cod}} </h5>
<h5 style="text-align:center; margin:0;padding:0;">NOMBRE DE LA CONVOCATORIA: {{$data["proceso"]->nombre}} </h5><br>
<h5 align="center" style="margin:0;padding:0;color:blue;text-transform: uppercase;">PUBLICACIÓN DE RESULTADOS DE EVALUACIÓN {{$data["etapa_actual"]["descripcion"]}}</h5><br>
<table class="tabla-reporte">
        <thead >
            <tr  >
                <th rowspan="2"  border="1">Orden <br>de Mérito</th>
                <th rowspan="2">DNI</th>
                <th rowspan="2">Apellidos y Nombres</th>                                                    
                <th rowspan="2">Puntaje</th>
                <th colspan="2">Resultado</th>
                                                           
            </tr>
            <tr>
                <th>Califica</th>
                <th>No Califica</th>                                                
            </tr>
        </thead>
        <tbody>   
            @foreach($data["postulantes"] as $key => $p)    
            <tr>
                <td align="center">
                    @if($p->calificacion=="1")
                        {{($key+1)}}
                    @endif
                </td>
                <td align="center">{{($p->dni)}} </td>
                <td>{{$p->nombres}}</td>  
                <td align="center">{{$p->evaluacion}}</td>  
                <td align="center">
                    @if($p->calificacion=="1")
                        x
                    @endif
                </td>  
                <td align="center">
                    @if($p->calificacion=="0")
                        x
                    @endif
                </td>                                                
            </tr> 
            @endforeach     
            @if(count($data["postulantes"]) < 1 )
            <tr>
                <td align="center" colspan="5"><i> No hay postulantes </i></td>
            </tr>
            @endif                           
        </tbody>                                            
</table>  


@endsection