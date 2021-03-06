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
                        <td  align="center" colspan="6">Proceso de concurso {{$data["proceso"]->cod}} </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="6" >NOMBRE DE LA CONVOCATORIA {{$data["proceso"]->nombre}} </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="6">PUBLICACIÓN DE RESULTADOS DE EVALUACIÓN {{$data["etapa_actual"]["descripcion"]}}</td>
                    </tr>
                    <tr>
                        <th rowspan="2"  border="1">Orden de Mérito</th>
                        <th rowspan="2"> DNI</th>
                        <th rowspan="2" style="width:50px;">Apellidos y Nombres</th>                                                    
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
                        <td>{{$p->dni}}</td>
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


    </body>
</html>

