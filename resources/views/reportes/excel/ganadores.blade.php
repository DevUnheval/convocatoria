<!DOCTYPE html>
<html>
    <head>
        <title>Reporte</title>
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
                    	
                        <td  align="center" colspan="12"><h3>LISTA DE GANADORES DEL {{ $data["codigos"]->primero }} HASTA {{ $data["codigos"]->ultimo }} </h3></td>
                          
                    </tr>
                    <tr>
                        <th align="center" border="1">N°</th>
                        <th align="center" border="1">CONDICION</th>
                        <th align="center" border="1">DNI</th>
                        <th align="center" style="width:40px;" border="1">APELLIDOS Y NOMBRES</th>            
                        <th align="center" border="1">EMAIL</th>
                        <th align="center" style="width:15px;" border="1">CELULAR</th>
                        <th align="center" style="width:15px;" border="1">FECH. NACIMIENTO</th>
                        <th align="center" style="width:15px;" border="1">CODIGO</th>
                        <th align="center" style="width:30px;" border="1">CARGO</th>
                        <th align="center" style="width:45px;" border="1">OFICINA</th>
                        <th align="center" border="1">REMUNERACION</th>
                        <th align="center" style="width:30px;" border="1">DOMICILIO</th>
                    </tr>
                 
                </thead>
                <tbody>   
                    @foreach($data["ganadores"] as $key => $g)    
                    <tr>
                        <td align="center">{{ $key+1 }}</td>
                        <td align="center">{{ $g->condicion}}</td>  
                        <td align="center">{{ $g->dni}} </td>
                        <td align="left">{{$g->nombres}}</td>  
                        <td align="left">{{ $g->email}}</td>
                        <td align="center">{{ $g->telefono_celular}}</td>
                        <td align="center">{{ $g->fecha_nacimiento}}</td>
                        <td align="center">{{ $g->cod}}</td>
                        <td align="left">{{ $g->nombre}}</td>
                        <td align="left">{{ $g->oficina}}</td>
                        <td align="center">{{ $g->remuneracion}}</td>
                        <td align="left">{{ $g->domicilio}}</td>
                    </tr> 
                    @endforeach     
                    @if(count($data["ganadores"]) < 1 )
                    <tr>
                        <td align="center" colspan="12"><i> No hay información en la fecha seleccionada </i></td>
                    </tr>
                    @endif                           
                </tbody>                                       
        </table>  


    </body>
</html>
