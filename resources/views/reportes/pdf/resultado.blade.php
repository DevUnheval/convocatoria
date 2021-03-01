@extends('reportes.pdf.plantilla')
@section('contenido')

<br> 
<h5 style="text-align:center; margin:0;padding:0;">Proceso de concurso {{$data["proceso"]->cod}} </h5>
<h5 style="text-align:center; margin:0;padding:0;">NOMBRE DE LA CONVOCATORIA: {{$data["proceso"]->nombre}} </h5><br>
<h5 align="center" style="margin:0;padding:0;color:blue;text-transform: uppercase;">PUBLICACIÓN DEL RESULTADO FINAL</h5><br>
<table class="tabla-reporte">
        <thead >
            <tr  >
                <th>Nº</th>
                <th>DNI</th> 
                <th width="300px">Apellidos y Nombres</th>                                                    
                <th>Ev. curricular</th>
                @if($data["proceso"]->evaluar_conocimientos)
                <th>Ev. Con. / Psic. </th>
                @endif
                <th>Ev. entrevista </th>
                <th>Bonificación Persona con Discapacidad (15% del puntaje total)</th>
                <th>Bonificación Licenciado FF.AA. (10% del Puntaje Total)</th>
                <th>Bonificación deportista calificado. (10% del Puntaje Total)</th>
                <th>Total</th>
                <th>Condicion</th>
                                                           
            </tr>
        </thead>
        <tbody>   
            @foreach($data["postulantes"] as $key => $p)    
            <tr>
                <td align="center">{{($key+1)}} </td>
                <td align="center">{{$p->dni}}</td>
                <td>{{$p->nombres}}</td>  
                <td align="center">{{$p->ev_curricular}}</td>  
                @if($data["proceso"]->evaluar_conocimientos)
                <td align="center">{{$p->ev_conocimiento}}</td>
                @endif
                <td align="center">{{$p->ev_entrevista}}</td>  
                <td align="center">{{$p->bonificacion}}</td>
                <td align="center">{{$p->bonificacion}}</td>
                <td align="center">{{$p->bonificacion}}</td>  
                <td align="center">{{$p->total}}</td>                
                <td align="center">Ganador</td>                                              
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