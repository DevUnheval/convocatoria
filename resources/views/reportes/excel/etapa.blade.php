<!DOCTYPE html>
<html>
    <head>
        <title>Reporte CONVOCATORIA XYZ</title>
    </head>
    <body>
        <table >
            <thead>
                <tr>
                <th style="border: 1px solid #000000;" colspan="6">TITULO</th>
                </tr>
                <tr>
                <th style="border: 1px solid #000000;">Nº</th>
                    <th style="border: 1px solid #000000;">DNI</th>
                    <th style="border: 1px solid #000000;">APELLIDOS</th>
                    <th style="border: 1px solid #000000;">NOMBRES</th>
                    <th style="border: 1px solid #000000;">PUNTAJE</th>
                    <th style="border: 1px solid #000000;">CALIFICACIÓN</th>
                </tr>
            </thead>
            <tbody>
            @foreach($postulantes as $key => $p)
                <tr>
                    <td style="border: 1px solid #000000;">{{($key+1)}}</td>
                    <td style="border: 1px solid #000000;">{{$p->user->dni}}</td>
                    <td style="border: 1px solid #000000;">{{$p->user->apellido_paterno.' '.$p->user->apellido_materno}}</td>
                    <td style="border: 1px solid #000000;">{{$p->user->nombres}}</td>
                    <td style="border: 1px solid #000000;">PUNTAJE</td>
                    <td style="border: 1px solid #000000;">CALIFICACIÓN</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>

