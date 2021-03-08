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
                <thead>
                    <tr>
                        <td  align="center" colspan="12">Proceso de concurso {{$data["proceso"]->cod}} </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="12" >NOMBRE DE LA CONVOCATORIA {{$data["proceso"]->nombre}} </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="12">PUBLICACIÓN DEL RESULTADO FINAL</td>
                    </tr>
                    <tr  >
                        <th>Nº</th>
                        <th>DNI</th> 
                        <th  style="width:50px;">Apellidos y Nombres</th>                                                    
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


    </body>
</html>

