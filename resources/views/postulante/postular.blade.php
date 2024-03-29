@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->

<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('/css/preloader.css')}}" rel="stylesheet" type="text/css">
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

<!-- This Page CSS -->
<link href="{{ asset('/material-pro/src/assets/extra-libs/prism/prism.css')}}" rel="stylesheet" type="text/css" > 
<link href="{{ asset('/css/acordion.css')}}" rel="stylesheet">
@endsection

@section('preload_postular')
<div id="loading-screen" style="display: none">
    
    <img src="{{ asset('/imagenes/preloader/spinning-circles.svg')}}" >
    <h4 id="text_cargando">Cargando</h4>
    
</div>
@endsection

@section('menu_title_1',$proceso->cod.' '.$proceso->nombre)
@section('menu_title_2','Postular')


@section('content')

    @include('postulante.modalformacion')
    @include('postulante.modalnuevacapacitacion')
    @include('postulante.modalnuevaexperiencia')
    @include('auth.m_fotografia')


<div class="col-12">
    <div class="card">
        <div class="alert alert-info bg-cyan" role="alert">
            <i class="dripicons-information mr-3"></i>  
            <h5 class="text-center text-white-50">Estas postulando al proceso:</h5>
            <strong> 
                <h2 class="text-center text-white font-weight-bold ">              
                    <div></i>{{$proceso->cod}} - {{$proceso->nombre}} <i class="fas fa-users mr-2 ml-5"></i>
                        <small>N° Plazas = {{$proceso->n_plazas}}</small>
                    </div>
                </h2>
            </strong> 
            
        </div>
        
        <div class="card-body wizard-content" >
            
            <form  id="datospostulante" data-id="{{$proceso->id}}" class="datospostulante_v validation-wizard wizard-circle mt-0" >
                @csrf
                
                <!-- Step 1 -->
                <h6>Datos Personales</h6>
                <section id="section1">
                    <div >
                        <!--
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="cargar_dni"> Cargar Documento de Identidad (DNI, Carné de Extranjería, Otro):<small class="mr-5"> .pdf</small></label>
                                   <span id="btn_doc_dni" class=""></span> <input type="file" class="material-inputs form-control" id="cargar_dni" name="cargar_dni" accept="application/pdf"> </div>
                                   <input type="hidden" id="input_hide_dni" value="0">
                            </div>
                            
                        </div> -->
                        <div class="row border shadow-sm p-3 mb-4 bg-white">
                            <div class="col-md-3">
                                <div class="col-md">
                                    <div class="border shadow-sm p-2 mb-2 mt-1 bg-white">
                                        <center class="mt-1">
                                            <img id="foto_perfil" src="{{ asset(str_replace('public/','storage/',Auth::user()->img))}}" alt="user" class="rounded" height="120" width="120">
                                            <div class="mt-1 mb-1 align-content-center">
                                                <button type="button" class="btn btn-outline-success " data-toggle="modal" data-target="#m_fotografia"
                                                    data-placement="bottom" title="" data-original-title="Actualizar Fotografía"><small>Actualizar Fotografía</small></button>
                                                
                                            </div>
                                                                                        
                                        </center>
                                    </div>
                                </div>    
                            </div>    
                            <div class="col-md-9">
                                <div class="row mt-1">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="apellido_materno"> Apellidos y Nombres : <span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" value="{{auth()->user()->apellido_paterno}} {{auth()->user()->apellido_materno}} {{auth()->user()->nombres}}" id="apellido_paterno" name="apellido_paterno" disabled> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dni"> DNI : <span class="text-danger">*</span> </label>
                                                <input type="text" value="{{auth()->user()->dni}}" class="form-control" id="dni" name="dni" disabled> </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email"> Correo electrónico : <span class="text-danger">*</span> </label>
                                                <input type="email" class="form-control" id="email" value="{{auth()->user()->email}}" name="email" disabled> </div>
                                        </div>
                                </div>
                                
                                <div class="row mt-3">
                                    
                                     <div class="col-md-9">
                                        <div class="">
                                            
                                            
                                                <label for="email"> Cargar Documento de Identidad (DNI, Carne de extranjería, otros): <label ><small>(solo archivos .pdf - Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB)</small> </label> <span class="text-danger">*</span> </label>
                                                <input type="file" class=" form-control" id="cargar_dni" name="cargar_dni" accept="application/pdf" onchange="validar_peso_archivo(this)" required> 
                                                <input type="hidden" id="input_hide_dni" value="0">                                                 
                                                
                                                
                                            
                                        </div>
                                     </div>
                                     <div class="col-md-3 pt-4">
                                        
                                            
                                            
                                                    <span id="btn_doc_dni" class=""></span>
                                               
                                            
                                        
                                     </div>
                             </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_nacimiento"> Fecha de nacimiento : <span class="text-danger ">*</span> </label>
                                    <input type="date" class="form-control " id="fecha_nacimiento" name="fecha_nacimiento" required> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ruc"> RUC<small> (opcional):</small> </label>
                                    <input type="text" class="form-control" value=""  id="ruc" name="ruc">
                                 </div>
                            </div>
                            
                               
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nacionalidad"> Nacionalidad : <span class="text-danger">*</span> </label>
                                        <select class="form-control " id="nacionalidad" name="nacionalidad" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Peruano(a)" selected>Peruano(a)</option>
                                            <option value="Extranjero(a)">Extranjero(a)</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ubigeodni"> Lugar de nacimiento : <span class="text-danger">*</span> </label>
                                        <!-- <input type="text" class="form-control " value="" id="ubigeodni" name="ubigeodni">  -->
                                        <div id="html_lugar_nac">
                                            <select class="form-control select_2 " id="ubigeodni" name="ubigeodni" required></select>
                                            <div class="invalid-feedback">
                                                Seleccione su lugar de nacimiento
                                            </div>
                                        </div>
                                        <div id="html_lugar_nac2" style="display: none;">
                                            <input type="text" class="form-control"  id="ubigeodni_alt">
                                            <div class="invalid-feedback">
                                                Seleccione su lugar de nacimiento
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono_celular"> Telefono celular : <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control " value="" id="telefono_celular" name="telefono_celular" required> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono_fijo"> Telefono fijo <small> (opcional)</small> : </label>
                                    <input type="text" class="form-control" value="" id="telefono_fijo" name="telefono_fijo"> </div>
                            </div>  
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="domicilio"> Domicilio : <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control " value="" id="domicilio" name="domicilio" required> </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ubigeo_domicilio">Lugar-Domicilio Actual: <span class="text-danger">*</span> </label>
                                    <!-- <input type="text" class="form-control " value="" id="ubigeo_domicilio" name="ubigeo_domicilio">  -->
                                    <select class="form-control select_2 required" id="ubigeo_domicilio" name="ubigeo_domicilio" required></select>
                                    <div class="invalid-feedback">
                                        Seleccione su lugar de domicilio
                                    </div> 
                                </div>
                            </div>  
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md">
                                
                            </div>
                        </div>    
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label > ¿Cuenta con certificado de discapacidad y/o registro en CONADIS?(Ley N° 29973) <span class="text-danger">*</span> </label>
                                    
                                </div>  
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="group1" value="true"  class=" group1 material-inputs "  value="1" type="radio" id="si_discapacidad"  />
                                    <label for="si_discapacidad">Si</label>
                                    <input name="group1" value="false" class=" group1 material-inputs " value="0" type="radio" id="no_discapacidad"  />
                                    <label for="no_discapacidad">No</label>
                                </div>   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label ><small>(solo archivos .pdf - Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB)</small> </label>
                                    <input name="file_discapacidad"  class="material-inputs" type="file" id="file_discapacidad" accept="application/pdf" onchange="validar_peso_archivo(this)" />
                                    <span id="btn_doc_disc" class=""></span><input type="hidden" id="input_hide_disc" value="0">
                                </div>   
                            </div>                               
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label > ¿Es licenciado de las FFAA ?(Ley Nº 29248) <span class="text-danger">*</span> </label>
                                    
                                </div>  
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="group2" value="true" class="group2 material-inputs " value="1" type="radio" id="si_ffaa"  />
                                    <label for="si_ffaa">Si</label>
                                    <input name="group2" value="false"  class="group2 material-inputs " value="0" type="radio" id="no_ffaa"  />
                                    <label for="no_ffaa">No</label>
                                </div>   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label ><small>(solo archivos .pdf - Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB)</small> </label>
                                    <input name="file_ffaa" id="file_ffaa"  class="material-inputs" type="file" accept="application/pdf" onchange="validar_peso_archivo(this)" >
                                    <span id="btn_doc_ffaa" class=""></span> <input type="hidden" id="input_hide_ffaa" value="0">
                                </div>   
                            </div>
                                                
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label > ¿Es deportista calificado? <span class="text-danger">*</span> </label>
                                    
                                </div>  
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="group3" value="true"  class=" group3 material-inputs " type="radio" id="si_deportista"  />
                                    <label for="si_deportista">Si</label>
                                    <input name="group3" value="false"  class=" group3 material-inputs " type="radio" id="no_deportista"  />
                                    <label for="no_deportista">No</label>
                                </div>   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label ><small>(solo archivos .pdf - Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB)</small> </label>
                                    <input name="file_deportista"  class="material-inputs" type="file" id="file_deportista" accept="application/pdf" onchange="validar_peso_archivo(this)" />
                                    <span id="btn_doc_deport" class=""></span> <input type="hidden" id="input_hide_deport" value="0">
                                </div>   
                            </div>
                                                
                        </div>

                       
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <label class="text-danger"> (*) Indica un campo obligatorio.<span class="text-danger"></span> </label>
                            </div>
                        </div>    
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    
                                  <!--  <button id="btn_guardardatos" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" >
                                    <i class="fa fa-plus "></i> Guardar</button>
                                       <button onclick="anios_meses_dias(365)" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" >
                                        <i class="fa fa-plus "></i> calcular tiempo</button>-->
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </section>
                <!-- Step 2 -->
                <h6>Formación Académica</h6>
                <section id="section2">
                    <br>
                    <div id="div_act">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" onclick="nueva_forma();" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nueva_formacion">
                                <i class="fa fa-plus"></i> Formación Académica</button>
                            </div>
                        </div>
                        <div class="col-md-5 offset-3">
                            @foreach ($proceso_formacion as $item)
                            <div class="alert alert-warning text-dark" style="aling-center" role="alert">
                                <strong>Formación mínima requerida: </strong> {{$item->nombre}} en {{$item->especialidad}}
                            </div>
                            @endforeach
                        </div>
                        
                    </div>                    
                    <div class="table-responsive">
                        <table id="zeroconfig1" class="table table-striped table-bordered">
                            <thead class="text-white bg-info">
                                <tr>
                                    <th>Grado de estudio</th>
                                    <th>Especialidad</th>
                                    <th>Centro de Estudios</th>
                                    <th>Fecha Expedición</th>
                                    <th>Acciones</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                                    <tbody id="zeroconfig1_body">
                                        
                                    </tbody>
                                
                            <tfoot>

                            </tfoot>
                            
                        </table>

                        
                    </div>
                 </div> 
                 <br><br>
                    
                    <div class="row p-2" >          
                        <div id="cont_colegiatura" class="col-md-4 shadow p-2 mb-2 mt-1 bg-light">
                            <div class="row" >  
                            <div class="col-md-1 float-right" >
                            <input style="width: 20px; height: 20px" id="check_colegiatura" type="checkbox" />
                            
                            </div>    

                        <div class="col-md-11" >
                            <label>
                                Estoy colegiado y habilitado (Adjuntar según lo solicitado en las bases)
                            </label>
                                <div id="div_colegiatura" style="display:none">
                                <input id="codigo_colegiatura" class="form-control" name="codigo_coleg" type="text" disabled placeholder="N° de colegiatura"/>
                                <label><strong>Constancia de habilitación </strong><small>(solo archivos .pdf - Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB)</small> </label>
                                <input id="file_colegiatura" class="form-control" type="file" disabled accept="application/pdf" onchange="validar_peso_archivo(this)" />
                                <span id="btn_doc_colegiatura" class=""></span> <input type="hidden" id="input_hide_licenciatura" value="0">
                            </div>
                        </div>  

                        <div class="col-md-4" >
                            
                            
                            
                        </div>  
                        </div> 
                        </div>                           
                    </div>
                  
                 <br>
                 <!-- 
                 <div class="row p-2" >          
                        <div id="cont_licencia" class="col-md-4 shadow p-2 mb-2 mt-1 bg-light">
                            <div class="row" >  
                            <div class="col-md-1 float-right" >
                            <input style="width: 20px; height: 20px" id="check_licencia" type="checkbox" />
                            
                            </div>    

                        <div class="col-md-11" >
                            <label>
                                Tengo licencia de conducir (Adjuntar según lo solicitado en las bases)
                            </label>
                                <div id="div_licencia" style="display:none">
                                <input id="codigo_licencia" class="form-control" name="codigo_coleg" type="text" disabled placeholder="N° de Li"/>
                                <label><strong>Licencia de conducir </strong><small>(solo archivos .pdf - Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB)</small> </label>
                                <input id="file_licencia" class="form-control" type="file" disabled accept="application/pdf" onchange="validar_peso_archivo(this)" />
                                <span id="btn_doc_licencia" class=""></span> <input type="hidden" id="input_hide_licenciaconducir" value="0">
                            </div>
                        </div>  
                        
                        <div class="col-md-4" >
                            
                            
                            
                        </div>  
                        </div> 
                        </div>                           
                    </div> -->
                <br>                     
                </section>
                
                <!-- Step 3 -->
                <h6>Cursos y/o Especializaciones</h6>
                <section id="section3">
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" onclick="nueva_capacitacion()" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nuevo">
                                <i class="fa fa-plus"></i> Cursos o Especialización</button>
                            </div>
                        </div>
                       
                       
                          <div class="col-md-5 offset-3">
                            
                            <div class="alert alert-warning text-center text-dark" role="alert">
                                <strong>Mínimo de horas por curso/capacitación: </strong><input type="hidden" class=" border-0 bg-light-danger text-dark-danger" value="{{$proceso->horas_cap_ind}}" disabled id="horas_cap_ind">
                                <label class=" border-0 bg-light-danger text-dark-danger">{{$proceso->horas_cap_ind}} Hrs.</label>
                                <label class=" border-0 bg-light-danger text-dark-danger">(*)La capacitación debe cumplir el mínimo de horas establecido para que pase a revisión</label>
                            </div>
                            
                          </div>
                      
                    </div>
                    
                    <div class="table-responsive">
                        <table id="zero_config2" class="table table-striped table-bordered">
                            <thead class="text-white bg-info">
                                <tr>
                                    <th>Tipo de estudio</th>
                                    <th>Descripción</th>
                                    <th>Institución</th>
                                    <th>Horas lectivas<br></th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="zeroconfig2_body">
                                    <!-- Cuerpo vacio -->
                                   
                            </tbody>
                            
                        </table>
                    </div>
                    <br><br><br>                
                </section>
                
                <!-- Step 4 -->
                <h6>Experiencia Laboral</h6>
                <section>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" onclick="nueva_expe();" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" >
                                <i class="fa fa-plus"></i> Experiencia Laboral</button>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="alert alert-success text-center" role="alert">
                                <strong>Mi Exper. General: </strong><input id="total_exp_general" name="total_exp_general" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled > 
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success text-center" role="alert">
                                <strong>Mi Exper. Específica: </strong><input id="total_exp_especifica" name="total_exp_especifica" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled > 
                            </div>

                          
                      </div>
                      <div class="col-md-4">
                        
                        <div class="alert alert-warning text-dark" role="alert">
                            <strong>Exper. General mínima: </strong><span id="exp_gen_pro">  </span> <br>
                            <strong>Exper. Específica mínima: </strong><span id="exp_esp_pro">  </span> 
                        </div>
                        
                      </div>
                      
                    </div>
                   
                    
                    <div class="table-responsive">
                        <table id="zero_config3" class="table table-striped table-bordered">
                            <thead class="text-white bg-info">
                                <tr>
                                    <th>Tipo de Experiencia</th>
                                    <th>Es experiencia</th>
                                    
                                    <th>Nombre Entidad</th>
                                    <th>Cargo<br></th>
                                    <th>Fecha Inicio/Fin <br><small>(Año-Mes-Dia)</small></th>
                                    
                                    <th>Tiempo Exper.</th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="zeroconfig3_body">
                                    <!-- Cuerpo vacio -->
                                   
                            </tbody>
                            
                        </table>
                    </div>
                    <br><br><br>                      
                </section>

                <!-- Step 5 -->
                <h6>Declaración Jurada</h6>
                <section>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3><strong>DECLARACIÓN JURADA</strong></h3>
                        </div>
                    </div>
                    <br>
                    <div class="row card-body bg-light">
                        <div class="col-md-2 ">
                            <input name="g1" class=" g1 material-inputs"  value="1" type="radio" id="si_p1"  />
                            <label for="si_p1">Si</label>
                            <input name="g1" class=" g1 material-inputs" value="0" type="radio" id="no_p1"  />
                            <label for="no_p1">No</label> 
                        </div>
                        <label class="col-md-10 border-left">1. Me encuentro inhabilitado administrativa o judicialmente para contratar con el Estado. </label>                                
                    </div> 
                    <div class="row card-body">
                        <div class="col-md-2">
                            <input name="g2" class=" g2 material-inputs"  value="1" type="radio" id="si_p2"  />
                            <label for="si_p2">Si</label>
                            <input name="g2" class=" g2 material-inputs" value="0" type="radio" id="no_p2" />
                            <label for="no_p2">No</label>
                        </div>
                        <label class="col-md-10 border-left">2. Me encuentro inmerso en algún Proceso Administrativo Disciplinario, o he sido destituido de la Administración Pública. </label>                                
                    </div>
                    <div class="row card-body bg-light">
                        <div class="col-md-2">
                            <input name="g3" class=" g3 material-inputs"  value="1" type="radio" id="si_p3"  />
                            <label for="si_p3">Si</label>
                            <input name="g3" class=" g3 material-inputs" value="0" type="radio" id="no_p3"  />
                            <label for="no_p3">No</label>  
                        </div>
                        <label class="col-md-10 border-left">3. Tengo antecedentes penales, judiciales y/o policiales.</label>                                
                    </div> 
                    <div class="row card-body">
                        <div class="col-md-2">
                            <input name="g4"   class=" g4 material-inputs"  value="1" type="radio" id="si_p4"  />
                            <label for="si_p4">Si</label>
                            <input name="g4"  class=" g4 material-inputs" value="0" type="radio" id="no_p4" />
                            <label for="no_p4">No</label>  
                        </div>
                        <label class="col-md-10 border-left">4. Tengo impedimento para ser postor o contratista, conforme a lo establecido en el marco normativo que regula las contrataciones y adquisiciones del Estado.</label>                                
                    </div> 
                    <div class="row card-body bg-light">
                        <div class="col-md-2 ">
                            <input name="g5"   class=" g5 material-inputs"  value="1" type="radio" id="si_p5"  />
                            <label for="si_p5">Si</label>
                            <input name="g5"  class=" g5 material-inputs" value="0" type="radio" id="no_p5" />
                            <label for="no_p5">No</label>  
                        </div>                            
                        <label class="col-md-10 border-left" value="" id="cod"> 5. Me une algún vínculo familiar y/o matrimonial hasta el cuarto grado de consanguinidad, segundo de afinidad con los funcionarios, directivos de la Universidad Nacional “Hermilio Valdizán” de Huánuco y con los miembros del Comisión de Concurso Público para Contrato Administrativo de Servicios - CAS {{$proceso->cod}}</label>                        
                    </div>
                    <div class="row card-body">
                        <div class="col-md-2 ">
                            <input name="g6"   class=" g6 material-inputs"  value="1" type="radio" id="si_p6"  />
                            <label for="si_p6">Si</label>
                            <input name="g6"  class=" g6 material-inputs" value="0" type="radio" id="no_p6"  />
                            <label for="no_p6">No</label>  
                        </div>
                        <label class="col-md-10 border-left">6. Percibo otro ingreso tipo de remuneración por parte del Estado o de alguna naturaleza.</label>                                
                    </div>  
                    <div class="row card-body bg-light">
                        <div class="col-md-2 ">
                            <input name="g7"   class=" g7 material-inputs"  value="1" type="radio" id="si_p7"  />
                            <label for="si_p7">Si</label>
                            <input name="g7"  class=" g7 material-inputs" value="0" type="radio" id="no_p7" />
                            <label for="no_p7">No</label>  
                        </div>
                        <label class="col-md-10 border-left">7. Percibo alguna pensión a cargo del Estado.</label>                                
                    </div>
                    <div class="row card-body">
                        <div class="col-md-2 ">
                            <input name="g8"   class=" g8 material-inputs"  value="1" type="radio" id="si_p8"  />
                            <label for="si_p8">Si</label>
                            <input name="g8"  class=" g8 material-inputs" value="0" type="radio" id="no_p8" />
                            <label for="no_p8">No</label>  
                        </div>
                        <label class="col-md-10 border-left">8. Soy deudor Alimentario Moroso y/o me encuentro inscrito en el Registro de Deudores Alimentarios de Morosos (REDAM), conforme a lo dispuesto por la Ley Nº28970.</label>                                
                    </div>
                    <!--<div class="row card-body bg-light">
                        <div class="col-md-2">
                            <input name="g9"   class=" g9 material-inputs"  value="1" type="radio" id="si_p9" checked />
                            <label for="si_p9">Si</label>
                            <input name="g9" class=" g9 material-inputs" value="0" type="radio" id="no_p9"  />
                            <label for="no_p9">No</label>  
                        </div>
                        <label class="col-md-10 border-left">9. Los documentos que declaro y presento son verídicos y fidedignos.</label>                                
                    </div> 
                    <br>
                    <div id="veracidad" class="row card-body border alert alert-success" >          
                        <div class="col-md-1 text-center justify-content-center align-items-center" >
                            <input style="width: 20px; height: 20px" id="check_dj" name="check_dj" value="1" type="checkbox" />
                        </div> 
                        <div class="col-md-11">
                            <h5>Manifiesto que lo mencionado en la presente Declaración Jurada, responde al principio de veracidad normado en el numeral 1.7 del artículo IV del Título Preliminar, y el artículo 42º de la Ley Nº 27444 “Ley del Procedimiento Administrativo General”; así mismo tengo pleno conocimiento que si incurro en una declaración falsa, estoy sujeto a las sanciones previstas en el artículo 411º del Código Penal vigente.</h5>  
                        </div>
                                                   
                    </div>  
                    --> 
                    <hr>                                        
                </section>

                <!-- Step 6 -->
                <h6>POSTULAR</h6>
                <section>
                    <div class="row">
                        <div class="col-md-12 justify-content-center">
                            <h3 class="text-center"><strong> RESUMEN DE POSTULACIÓN</strong></h3>
                        </div>
                    </div>
                    <!-- Inicio  Acordion---------->
                    <div class="card col-md">                        
                        <div class="row">
                            <div class="card-body form-row ">                                    
                                <div class="col-3 border form-group alert-warning">
                                    <center><img src="{{ asset(str_replace('public/','storage/',Auth::user()->img))}}" alt="user" width="120" height="120"></center>
                                </div>
                                <div class="col-4 border form-group alert-warning">
                                    <small class="text-center text-dark-info font-weight-bold "><strong>ESTAS POSTULANDO AL PROCESO: </strong></small> <br>{{$proceso->cod}}                                                
                                    <br>
                                    <small><strong  class="text-dark-info font-weight-bold">N° Plazas = </strong> </small><br>{{$proceso->n_plazas}}
                                </div>                                        
                                <div class="col-5 border form-group alert-warning">
                                    <small ><strong class="text-center text-dark-info font-weight-bold">PUESTO AL QUE POSTULA:  </strong> </small><br>{{$proceso->nombre}}
                                    <br>
                                    <small ><strong class="text-center text-dark-info font-weight-bold">AREA/OFICINA:  </strong> </small> <br>{{$proceso->oficina}}
                                </div>
                            </div>                   
                        </div>
                        
<!--------------------------- INICIO ACORDION -------------------->
                        @include('postulante.acordion-postular')
<!--------------------------- FIN ACORDION -------------------->
                        <div class="card-body">
                            <div id="veracidad" class="row card-body border alert alert-success" >          
                                <div class="col-md-1 text-center justify-content-center align-items-center" >
                                    <input style="width: 20px; height: 20px" id="check_dj" name="check_dj" value="1" type="checkbox" />
                                </div>                         
                                <div class="col-md-11" for="check_dj">
                                    <h5>
                                        Manifiesto que la información registrada responde al principio de veracidad normado en el 
                                        numeral 1.7 del artículo IV del Título Preliminar, y el artículo 42º de la Ley Nº 27444 “Ley 
                                        del Procedimiento Administrativo General”; así mismo tengo pleno conocimiento que si incurro 
                                        en una declaración falsa, estoy sujeto a las sanciones previstas en el artículo 411º del Código 
                                        Penal vigente.
                                    </h5>  
                                </div>                             
                            </div>
                        </div>                                       
                    </div>                      
                    <br>
                    <br>                                        
                </section>
            </form>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Example -->
<!-- ============================================================== -->
    
@endsection

@section('js')

<script>
    var pesoMaxArchivo = '{{$pesoMaxArchivo}}'; 
    var pesoMaxArchivo_MB = pesoMaxArchivo/1048576;
        pesoMaxArchivo_MB = pesoMaxArchivo_MB.toFixed(1); 
 </script>
 
<script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>
<script src="{{ asset('/material-pro/src/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
<script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('/js/postulante.js')}}"></script>
<script src="{{ asset('/js/tablas_postular.js')}}"></script>
<script src="{{ asset('/js/moment.min.js')}}"></script>
<script src="{{ asset('/material-pro/src/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('/material-pro/src/assets/libs/select2/dist/js/select2.min.js')}}"></script> 
<script src="{{ asset('/js/ubigeo_reniec_select2.js')}}"></script>
<script src="{{ asset('/material-pro/src/assets/extra-libs/prism/prism.js')}}"></script>
<script src="{{ asset('/js/acordion.js')}}"></script>

<script src="{{ asset('/js/update_fotografia.js')}}"></script>
<script src="{{ asset('/js/validar_peso_archivo.js')}}"></script>
@endsection

