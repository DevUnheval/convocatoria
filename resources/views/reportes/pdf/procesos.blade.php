@extends('reportes.pdf.plantilla')
@section('contenido')

<br> 
<h3>título título</h3>
<table class="tabla-reporte">
        <thead >
            <tr>
                <th rowspan="2">Orden de Mérito</th>
                <th rowspan="2">Apellidos y Nombres</th>                                                    
                <th rowspan="2">Puntaje</th>
                <th colspan="2">Resultado</th>
                                                           
            </tr>
            <tr>
                <th>Califica</th>
                <th>No Califica</th>                                                
            </tr>
        </thead>
        <tbody id="">                                           
        </tbody>                                            
</table>  

@endsection