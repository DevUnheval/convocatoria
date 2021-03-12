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
        <td id="res_ruc">{{$postulante->datos_postulante->ruc}}</td>
    </tr>
    <tr>
        <th class="cv-tabla-th">FECHA DE NAC.</th>
        <td class="cv-tabla-td">{{date_format(date_create($postulante->datos_postulante->fecha_nacimiento),"d/m/Y")}}</td>
        <th class="cv-tabla-th">LUGAR DE NAC.</th>
        <td class="cv-tabla-td">{{$postulante->datos_postulante->desc_ubigeo_nac()}}</td>
    </tr>
    <tr>
        <th class="cv-tabla-th">Nº Celular / Teléfono</th>
        <td class="cv-tabla-td">{{$postulante->datos_postulante->telefono_celular}} / {{$postulante->datos_postulante->telefono_fijo}}</td>
        <th class="cv-tabla-th">CORREO ELECTRÓNICO</th>
        <td class="cv-tabla-td">{{$postulante->user->email}} </td>
    </tr>
    <tr>
        <th class="cv-tabla-th">DOMICILIO</th>
        <td class="cv-tabla-td" colspan="3"> {{$postulante->datos_postulante->domicilio}} ({{$postulante->datos_postulante->desc_ubigeo_nac()}})</td>
    </tr>
    <tr>
        <th scope="row" colspan="4" class=""></th>
    </tr>
    <tr>
        <th class="cv-tabla-th" colspan="3"  >¿Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N° 29973) </th>
        <td class="cv-tabla-td">
          @if($postulante->datos_postulante->es_pers_disc) SI
          @else   NO @endif
        </td>
    </tr>
    <tr>
        <th class="cv-tabla-th"colspan="3"  >¿Es licenciado de las FFAA ? (Ley Nº 29248) </th>
        <td class="cv-tabla-td">
          @if($postulante->datos_postulante->es_lic_ffaa) SI
          @else   NO @endif
        </td>
    </tr>
    <tr>
        <th class="cv-tabla-th"colspan="3"  >¿Es deportista calificado? </th>
        <td class="cv-tabla-td">
          @if($postulante->datos_postulante->es_deportista) SI
          @else   NO @endif
        </td>
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
    @foreach($postulante->formacion_postulante as $key => $formacion)
    <tr>
        <td class="cv-tabla-td">{{$formacion->gradoformacion->nombre}}</td>
        <td class="cv-tabla-td">{{$formacion->especialidad}}</td>
        <td class="cv-tabla-td">{{$formacion->centro_estudios}}</td>
        <td class="cv-tabla-td">{{date_format(date_create($formacion->fecha_expedicion),"d/m/Y")}}</td>
    </tr>
    @endforeach
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
        <th class="cv-tabla-th">Tipo</th>
        <th class="cv-tabla-th">Descripción</th>
        <th class="cv-tabla-th">Institución</th>
        <th class="cv-tabla-th">Horas lectivas</th>        
    </tr>
    @foreach($postulante->capacitacionpostulantes as $key => $formacion)
    <tr>
        <td class="cv-tabla-td-dj">
          @if($formacion->es_curso_espec)
            Capacitación / Especialización
          @elseif($formacion->es_ofimatica)
            OFIMATICA
          @elseif($formacion->es_idioma)
            IDIOMA
          @endif
        </td>
        <td class="cv-tabla-td">{{$formacion->especialidad}}</td>
        <td class="cv-tabla-td">{{$formacion->centro_estudios}}</td>
        <td class="cv-tabla-td">{{$formacion->cantidad_horas}}</td>
    </tr>
    @endforeach
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
        <th class="cv-tabla-th">Tipo</th>
        <th class="cv-tabla-th">Es experiencia</th>
        <th class="cv-tabla-th">Entidad</th>
        <th class="cv-tabla-th">Cargo</th>
        <th class="cv-tabla-th"> Inicio</th>
        <th class="cv-tabla-th"> Fin</th>
        <th class="cv-tabla-th">Tiempo Exper.</th>        
    </tr>
    @foreach($postulante->experieciapostulantes as $key => $experiencia)
    <tr>
        <td class="cv-tabla-td-dj">{{$experiencia->tipoexperiencia()}}</td>
        <td class="cv-tabla-td-dj">
          General
          @if($experiencia->es_exp_esp)
          <br> Específica
          @endif
        </td>
        <td class="cv-tabla-td-dj">
          {{$experiencia->centro_laboral }}
          @if($experiencia->tipo_experiencia)
            (privado)
          @else
          (público)
          @endif
        
        </td>
        <td class="cv-tabla-td-dj">{{$experiencia->cargo_funcion}}</td>
        <td class="cv-tabla-td-dj"> {{date_format(date_create($formacion->fecha_inicio),"d/m/Y")}} </td>
        <td class="cv-tabla-td-dj"> {{date_format(date_create($formacion->fecha_fin),"d/m/Y")}}</td>
        <td class="cv-tabla-td-dj"> {{$experiencia->calcular_expericia()}}</td>
    </tr>
    @endforeach
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
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >2. Me encuentro inmerso en algún Proceso Administrativo Disciplinario, o he sido destituido de la Administración Pública.  </td>
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >3. Tengo antecedentes penales, judiciales y/o policiales. </td>
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >4. Tengo impedimento para ser postor o contratista, conforme a lo establecido en el marco normativo que regula las contrataciones y adquisiciones del Estado.</td>
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >5. Me une algún vínculo familiar y/o matrimonial hasta el cuarto grado de consanguinidad, segundo de afinidad con los funcionarios, directivos de la Universidad Nacional “Hermilio Valdizán” de Huánuco y con los miembros del Comisión de Concurso Público para Contrato Administrativo de Servicios - </td>
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >6. Percibo otro ingreso tipo de remuneración por parte del Estado o de alguna naturaleza.</td>
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >7. Percibo alguna pensión a cargo del Estado.</td>
        <td align="center">NO</td>
    </tr>
    <tr>
        <td class="cv-tabla-td-dj" colspan="3"  >8. Soy deudor Alimentario Moroso y/o me encuentro inscrito en el Registro de Deudores Alimentarios de Morosos (REDAM), conforme a lo dispuesto por la Ley Nº28970.</td>
        <td align="center">NO</td>
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
      @php 
        $fecha_postulacion = date_create($formacion->fecha_expedicion); 
      @endphp
      <td align="center" >{{date_format($fecha_postulacion,"d")}}</td>
      <td align="center" >{{date_format($fecha_postulacion,"m")}}</td>
      <td align="center" >{{date_format($fecha_postulacion,"Y")}}</td>       
    </tr>
  </tbody>                                            
</table>



@endsection