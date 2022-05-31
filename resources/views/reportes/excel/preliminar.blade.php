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
        @foreach($data["proceso_enca"] as $key2=>$p)
        <table class="tabla-reporte">
                <thead>
                    <tr>
                        <td  align="center" colspan="5">Proceso de concurso {{$p->cod}} </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="5" >NOMBRE DE LA CONVOCATORIA {{$p->nombre}} </td>
                    </tr>
                    <tr>
                        <td  align="center" colspan="5">LISTA DE POSTULANTES</td>
                    </tr>
                    <tr>
                        <th rowspan="2"  border="1">Orden de Mérito</th>
                        <th rowspan="2"  border="1">Celular</th>
                        <th rowspan="2" style="width:50px;">Apellidos y Nombres</th>            
                        <th colspan="2">Resultado</th>
                                                                
                    </tr>
                    <tr>
                        <th>Califica</th>
                        <th>No Califica</th>                                                
                    </tr>
                </thead>
                <tbody>   
                    @foreach($data["postu"][$key2] as $key => $p)    
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
                        <td align="center" colspan="4"><i> No hay postulantes </i></td>
                    </tr>
                    @endif                           
                </tbody>                                       
        </table>  
        @endforeach 

    </body>
</html>

