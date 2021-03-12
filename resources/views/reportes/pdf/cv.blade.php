@extends('reportes.pdf.plantilla')
@section('contenido')

<h3 style="text-align:center; margin:0;padding:0; color:#033067;">RESUMEN DE HOJA DE VIDA </h3>
<br>
<!-- Resumen -->
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>      
      <th scope="row" style="font-size:80%; background-color:#7fd039;">ESTAS POSTULANDO AL PROCESO</th>
      <th scope="row" style="font-size:80%; background-color:#7fd039;">PUESTO AL QUE POSTULA:</th>
      <th rowspan="4">Imagen</th>
    </tr>
    <tr>
      <td style="font-size:70%; text-align:center;">004-2021</td>
      <td style="font-size:70%; text-align:center;">Apoyo Administrativo</td>
    </tr>
    <tr>
      <th style="font-size:80%; background-color:#7fd039;">N° PLAZAS: </th>
      <th style="font-size:80%; background-color:#7fd039;">AREA/OFICINA:</th>
    </tr>
    <tr>
      <td style="font-size:70%; text-align:center;">5</td>
      <td style="font-size:70%; text-align:center;">Unidad de Recursos Humanos</td>
    </tr>       
  </tbody>                                            
</table>
<br>

<!-- DATOS PERSONALES -->
<table width="100%" border="1" cellpadding="5" cellspacing="2" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">I. DATOS PERSONALES</th>        
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Apellidos y Nombres</th>
        <td colspan="3">{{auth()->user()->apellido_paterno}} {{auth()->user()->apellido_materno}}, {{auth()->user()->nombres}}</td>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Documentos de Identidad</th>
        <td>{{auth()->user()->dni}}</td>
        <th style="background-color:#e2e3e5;">RUC:</th>
        <td id="res_ruc"></td>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Fecha de Nacimiento</th>
        <td id="res_fecha_nac"></td>
        <th style="background-color:#e2e3e5;">Dist.-Prov.-Dep:</th>
        <td id="res_ubigeo_nac"></td>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Celular N° </th>
        <td id="res_celular"></td>
        <th style="background-color:#e2e3e5;">Correo Electrónico</th>
        <td>{{auth()->user()->email}}</td>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Dirección Actual </th>
        <td id="res_direccion"></td>
        <th style="background-color:#e2e3e5;">Dist.-Prov.-Dep:</th>
        <td id="res_ubigeo_direc"></td>
    </tr>
    <tr>
        <th scope="row" colspan="4" class=""></th>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;"colspan="3"  >¿Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N° 29973) </th>
        <td id="res_disc"></td>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;"colspan="3"  >¿Es licenciado de las FFAA ? (Ley Nº 29248) </th>
        <td id="res_ffaa"></td>
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;"colspan="3"  >¿Es deportista calificado? </th>
        <td id="res_depor"></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- FORMACION ACADEMICA -->
<table width="100%" border="1" cellpadding="5" cellspacing="2" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">II. FORMACIÓN ACADÉMICA</th>        
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Grado de estudio</th>
        <th style="background-color:#e2e3e5;">Especialidad</th>
        <th style="background-color:#e2e3e5;">Centro de Estudios</th>
        <th style="background-color:#e2e3e5;">Fecha Expedición</th>        
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- CURSOS Y/O ESPECIALIZACIONES -->
<table width="100%" border="1" cellpadding="5" cellspacing="2" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">III. CURSOS Y/O ESPECIALIZACIONES</th>        
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Tipo de estudio</th>
        <th style="background-color:#e2e3e5;">Descripción</th>
        <th style="background-color:#e2e3e5;">Institución</th>
        <th style="background-color:#e2e3e5;">Horas lectivas</th>        
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- EXPERIENCIA LABORAL -->
<table width="100%" border="1" cellpadding="5" cellspacing="2" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>
        <th colspan="7" style="background-color:#3da0ce;color:#ffffff;">IV. EXPERIENCIA LABORAL</th>        
    </tr>
    <tr>
        <th style="background-color:#e2e3e5;">Tipo de Experiencia</th>
        <th style="background-color:#e2e3e5;">Es experiencia</th>
        <th style="background-color:#e2e3e5;">Nombre Entidad</th>
        <th style="background-color:#e2e3e5;">Cargo</th>
        <th style="background-color:#e2e3e5;">Fecha Inicio</th>
        <th style="background-color:#e2e3e5;">Fecha Fin</th>
        <th style="background-color:#e2e3e5;">Tiempo Exper.</th>        
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- DECLARACION JURADA -->
<table width="100%" border="1" cellpadding="5" cellspacing="2" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody>
    <tr>
        <th colspan="4" style="background-color:#3da0ce;color:#ffffff;">V. DECLARACIÓN JURADA</th>        
    </tr>
    <tr>
        <th colspan="3" style="background-color:#e2e3e5;">Descripción</th>
        <th style="background-color:#e2e3e5;">Respuesta</th>       
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >1. Me encuentro inhabilitado administrativa o judicialmente para contratar con el Estado. </td>
        <td id="res_dj1"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >2. Me encuentro inmerso en algún Proceso Administrativo Disciplinario, o he sido destituido de la Administración Pública.  </td>
        <td id="res_dj2"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >3. Tengo antecedentes penales, judiciales y/o policiales. </td>
        <td id="res_dj3"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >4. Tengo impedimento para ser postor o contratista, conforme a lo establecido en el marco normativo que regula las contrataciones y adquisiciones del Estado.</td>
        <td id="res_dj4"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >5. Me une algún vínculo familiar y/o matrimonial hasta el cuarto grado de consanguinidad, segundo de afinidad con los funcionarios, directivos de la Universidad Nacional “Hermilio Valdizán” de Huánuco y con los miembros del Comisión de Concurso Público para Contrato Administrativo de Servicios - </td>
        <td id="res_dj5"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >6. Percibo otro ingreso tipo de remuneración por parte del Estado o de alguna naturaleza.</td>
        <td id="res_dj6"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >7. Percibo alguna pensión a cargo del Estado.</td>
        <td id="res_dj7"></td>
    </tr>
    <tr>
        <td style="text-align:left;" colspan="3"  >8. Soy deudor Alimentario Moroso y/o me encuentro inscrito en el Registro de Deudores Alimentarios de Morosos (REDAM), conforme a lo dispuesto por la Ley Nº28970.</td>
        <td id="res_dj8"></td>
    </tr>
  </tbody>                                            
</table>
<br>
<!-- marcar x -->
<table widtd="100%" border="1" cellpadding="5" cellspacing="2" bordercolor="#000000" style="border-collapse:collapse;border-color:#000000;">
  <tbody style="background-color:#c3d88f;">
    <tr>
      <th >Marcar con "X"</th>
      <td rowspan="2">Manifiesto que la información registrada responde al principio de veracidad normado en el 
                                        numeral 1.7 del artículo IV del Título Preliminar, y el artículo 42º de la Ley Nº 27444 “Ley 
                                        del Procedimiento Administrativo General”; así mismo tengo pleno conocimiento que si incurro 
                                        en una declaración falsa, estoy sujeto a las sanciones previstas en el artículo 411º del Código 
                                        Penal vigente.</td> 
    </tr>
    <tr>
        <td></td>        
    </tr>
  </tbody>                                            
</table>
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
      <td><br></td>
      <td><br></td>
      <td><br></td>       
    </tr>
  </tbody>                                            
</table>



@endsection