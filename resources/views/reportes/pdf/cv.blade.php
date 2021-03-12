@extends('reportes.pdf.plantilla')

@section('css')
<style>
.cv-tabla{
  border-spacing: 10px;
  border-collapse: collapse;  
  width:100%;
}
.cv-tabla td, .cv-tabla th{
  padding:5px;
  border: 1px solid #AED6F1;
}
.cv-tabla-cabecera{
  background-color:#3da0ce;
  color:#ffffff;
  border:#3da0ce;
}
.cv-tabla-th{
  background-color:#D6EAF8;
  font-size:12px;
}
.cv-tabla-td{
  font-size:12px;
}
.cv-tabla-td-dj{
  font-size:10px;
}
</style>
@endsection

@section('contenido')
<br>
<h3 style="text-align:center; margin:0;padding:0; color:#033067;"> HOJA DE VIDA </h3>
<br>
<!-- Resumen -->
<div align="center">
<img src="{{asset('imagenes/ajustes/logo.png')}}"  style="max-width:200px; border-style: ridge;">
</div>
<br>

<!-- DATOS PERSONALES -->
<table  class="cv-tabla">
  <tbody>
    <tr>
        <th colspan="4" class="cv-tabla-cabecera">I. DATOS PERSONALES</th>        
    </tr>
    <tr>
        <th class="cv-tabla-th">APELLIDOS Y NOMBRES</th>
        <td colspan="3" class="cv-tabla-td">{{$postulante->user->apellido_paterno}} {{$postulante->user->apellido_materno}}, {{$postulante->user->nombres}}</td>
    </tr>
    <tr>
        <th class="cv-tabla-th">Nº DE DNI / PASAPORTE</th>
        <td class="cv-tabla-td">{{$postulante->user->dni}}</td>
        <th class="cv-tabla-th">RUC:</th>
        <td id="res_ruc">{{$postulante->ruc}}</td>
    </tr>
    <tr>
        <th class="cv-tabla-th">FECHA DE NACIMIENTO </th>
        <td class="cv-tabla-td">{{$postulante->fecha_nacimiento}}</td>
        <th class="cv-tabla-th">LUGAR DE NAC.</th>
        <td class="cv-tabla-td">{{\App\DatosPostulante::find(1)->desc_ubigeo_reniec('$postulante->datos_postulante->ubigeo_nacimiento')}}</td>
    </tr>
    <tr>
        <th class="cv-tabla-th">Nº Celular</th>
        <td class="cv-tabla-td"></td>
        <th class="cv-tabla-th">CORREO ELECTRÓNICO</th>
        <td class="cv-tabla-td">micorreo@servidormailcom</td>
    </tr>
    <tr>
        <th class="cv-tabla-th">DOMICILIO</th>
        <td class="cv-tabla-td" colspan="3"> </td>
    </tr>
    <tr>
        <th scope="row" colspan="4" class=""></th>
    </tr>
    <tr>
        <th class="cv-tabla-th" colspan="3"  >¿Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N° 29973) </th>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <th class="cv-tabla-th"colspan="3"  >¿Es licenciado de las FFAA ? (Ley Nº 29248) </th>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <th class="cv-tabla-th"colspan="3"  >¿Es deportista calificado? </th>
        <td class="cv-tabla-td"></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- FORMACION ACADEMICA -->
<table class="cv-tabla">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">II. FORMACIÓN ACADÉMICA</th>        
    </tr>
    <tr>
        <th class="cv-tabla-th">Grado de estudio</th>
        <th class="cv-tabla-th">Especialidad</th>
        <th class="cv-tabla-th">Centro de Estudios</th>
        <th class="cv-tabla-th">Fecha Expedición</th>        
    </tr>
    <tr>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- CURSOS Y/O ESPECIALIZACIONES -->
<table class="cv-tabla">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">III. CURSOS Y/O ESPECIALIZACIONES</th>        
    </tr>
    <tr>
        <th class="cv-tabla-th">Tipo de estudio</th>
        <th class="cv-tabla-th">Descripción</th>
        <th class="cv-tabla-th">Institución</th>
        <th class="cv-tabla-th">Horas lectivas</th>        
    </tr>
    <tr>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- EXPERIENCIA LABORAL -->
<table class="cv-tabla">
  <tbody>
    <tr>
        <th colspan="7" style="background-color:#3da0ce;color:#ffffff;">IV. EXPERIENCIA LABORAL</th>        
    </tr>
    <tr>
        <th class="cv-tabla-th">Tipo de Experiencia</th>
        <th class="cv-tabla-th">Es experiencia</th>
        <th class="cv-tabla-th">Nombre Entidad</th>
        <th class="cv-tabla-th">Cargo</th>
        <th class="cv-tabla-th">Fecha Inicio</th>
        <th class="cv-tabla-th">Fecha Fin</th>
        <th class="cv-tabla-th">Tiempo Exper.</th>        
    </tr>
    <tr>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
        <td class="cv-tabla-td"></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- DECLARACION JURADA -->
<table class="cv-tabla">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">V. DECLARACIÓN JURADA</th>        
    </tr>
    <tr>
        <th colspan="3" class="cv-tabla-th">Descripción</th>
        <th class="cv-tabla-th">Respuesta</th>       
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >1. Me encuentro inhabilitado administrativa o judicialmente para contratar con el Estado. </td>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >2. Me encuentro inmerso en algún Proceso Administrativo Disciplinario, o he sido destituido de la Administración Pública.  </td>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >3. Tengo antecedentes penales, judiciales y/o policiales. </td>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >4. Tengo impedimento para ser postor o contratista, conforme a lo establecido en el marco normativo que regula las contrataciones y adquisiciones del Estado.</td>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >5. Me une algún vínculo familiar y/o matrimonial hasta el cuarto grado de consanguinidad, segundo de afinidad con los funcionarios, directivos de la Universidad Nacional “Hermilio Valdizán” de Huánuco y con los miembros del Comisión de Concurso Público para Contrato Administrativo de Servicios - </td>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >6. Percibo otro ingreso tipo de remuneración por parte del Estado o de alguna naturaleza.</td>
        <td class="cv-tabla-td"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >7. Percibo alguna pensión a cargo del Estado.</td>
        <td id="res_dj7"></td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >8. Soy deudor Alimentario Moroso y/o me encuentro inscrito en el Registro de Deudores Alimentarios de Morosos (REDAM), conforme a lo dispuesto por la Ley Nº28970.</td>
        <td id="res_dj8"></td>
    </tr>
  </tbody>                                            
</table>
<br>

<!-- firma-->
<br><br><br><br><br><br><br><br>
<table width="20%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>
      <th colspan="3">Fecha</th>
    </tr>
    <tr>
      <td style="text-align:center;">Día</td>
      <td style="text-align:center;">Mes</td>
      <td style="text-align:center;">Año</td>
    </tr>
    <tr>
      <td class="cv-tabla-td"><br></td>
      <td class="cv-tabla-td"><br></td>
      <td class="cv-tabla-td"><br></td>       
    </tr>
  </tbody>                                            
</table>



@endsection