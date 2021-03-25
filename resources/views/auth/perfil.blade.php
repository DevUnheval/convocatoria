@extends('layouts.material')

@section('css')
<link href="{{ asset('/material-pro/src/assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('/css/preloader.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('preload_postular')
<div id="loading-screen" style="display: none">
    
    <img src="{{ asset('/imagenes/preloader/spinning-circles.svg')}}" >
    <h4 id="text_cargando">Cargando</h4>
    
</div>
@endsection

@section('title','Ajustes')

@section('menu_title_1','Perfil de usuario')
@section('menu_title_2','Perfil')

@section('content')
    @include('auth.m_contraseña')
    @include('postulante.modalformacion')
    @include('postulante.modalnuevacapacitacion')
    @include('postulante.modalnuevaexperiencia')
    @include('auth.m_fotografia')
        
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    
                    <!-- Column -->
                    <!-- Column -->
                    
                    @if(auth()->check() && auth()->user()->hasRoles(['Administrador','Comisionado']))
                       <div class="col-lg col-xlg col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-0">
                                    @foreach(auth()->user()->roles as $rol)
                                    <button class="btn waves-effect waves-light btn-rounded btn-success" disabled> {{$rol->nombre}}</button>
                                    <hr>
                                    @endforeach
                                    <img id="foto_perfil" src="{{ asset(str_replace('public/','storage/',Auth::user()->img))}}" alt="user" class="rounded-circle" height="150" width="150">
                                    <div class="card-body align-content-center">
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#m_fotografia"
                                            data-placement="bottom" title="" data-original-title="Actualizar Fotografía"><small>Actualizar Fotografía</small></button>
                                        
                                    </div>
                                    <h4 class="card-title mt-0">{{auth()->user()->nombres.' '.auth()->user()->apellido_paterno.' '.auth()->user()->apellido_materno}}</h4>
                                    
                                </center>
                            </div>
                            
                                 
                                <center>
                                <div class="card-body"> 
                                    <hr>
                                    <small class="text-muted">DNI</small> 
                                        <h6>{{auth()->user()->dni}}</h6> 
                                    
                                    <small class="text-muted pt-4 db">Correo</small> 
                                        <h6>{{auth()->user()->email}}</h6>  
                                    
                                    <hr> 
                                    <button id="btn_update_password" type="button" class="btn btn-info" data-toggle="modal" data-target="#m_contraseña"
                                    data-placement="bottom" title="" data-original-title="Modificar Contaseña">Cambiar Contraseña <i class="mdi mdi-account-key font-20 ml-2"></i></button>
                                
                                </div>
                                </center>
                        </div>
                    </div>
                                    
                   
                    @else

                    <div class="col-lg col-xlg col-md">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-0">
                                    @foreach(auth()->user()->roles as $rol)
                                    <button class="btn waves-effect waves-light btn-rounded btn-success" disabled> {{$rol->nombre}}</button>
                                    @endforeach
                                    <hr>
                                    <img id="foto_perfil" src="{{ asset(str_replace('public/','storage/',Auth::user()->img))}}" alt="user" class="rounded-circle" width="150" height="150">
                                    <div class="card-body align-content-center">
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#m_fotografia"
                                            data-placement="bottom" title="" data-original-title="Actualizar Fotografía"><small>Actualizar Fotografía</small></button>
                                        
                                    </div>
                                    <h4 class="card-title mt-0">{{auth()->user()->nombres.' '.auth()->user()->apellido_paterno.' '.auth()->user()->apellido_materno}}</h4>
                                                                       
                                </center>
                                <hr>
                            </div>
                            <center>   
                                <div class="card-body"> 
                                    
                                    <small class="text-muted">DNI</small> 
                                        <h6>{{auth()->user()->dni}}</h6> 
                                    
                                    <small class="text-muted pt-4 db">Correo</small> 
                                        <h6>{{auth()->user()->email}}</h6>  
                                    
                                    <hr> 
                                    <button id="btn_update_password" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#m_contraseña"
                                    data-placement="bottom" title="" data-original-title="Modificar Contaseña"><small>Cambiar Contraseña <i class="mdi mdi-account-key font-20 ml-2"></i></small></button>
                                
                                </div>
                            </center>
                        </div>
                    </div>

                    <div class="col-lg-9 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Datos Personales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Formación Académica</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Capacitaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#hi-month" role="tab" aria-controls="pills-setting" aria-selected="false">Experiencia Laboral</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body wizard-content">
                                        <form class="form-horizontal form_datospers_perfil" novalidate>
                                            <div class="card-body">
                                                <!--
                                                <div class="row">
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <label for="cargar_dni"> Cargar Documento de Identidad (DNI, Carné de Extranjería, Otro):<small class="mr-5"> .pdf</small></label>
                                                           <span id="btn_doc_dni" class=""></span> <input type="file" class="material-inputs form-control required" id="cargar_dni" name="cargar_dni" accept="application/pdf"> </div>
                                                           <input type="hidden" id="input_hide_dni" value="0">
                                                    </div>
                                                    
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ruc"> RUC (opcional):  </label>
                                                            <input type="text" class="form-control " value=""  id="ruc" name="ruc"> </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento"> Fecha de nacimiento : <span class="text-danger required">*</span> </label>
                                                            <input type="date" class="form-control required" id="fecha_nacimiento" name="fecha_nacimiento" required> </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                    
                                                
                                                <div class="row">
                                                   
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nacionalidad"> Nacionalidad : <span class="text-danger">*</span> </label>
                                                                <select class="form-control required" id="nacionalidad" name="nacionalidad" required>
                                                                    <option value="">Seleccionar</option>
                                                                    <option value="Peruano(a)" selected>Peruano(a)</option>
                                                                    <option value="Extranjero(a)">Extranjero(a)</option>
                                                                </select>
                                                            </div>    
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="ubigeodni"> Lugar de nacimiento : <span class="text-danger">*</span> </label>
                                                                <!-- <input type="text" class="form-control required" value="" id="ubigeodni" name="ubigeodni">  -->
                                                                <div id="html_lugar_nac">
                                                                    <select class="form-control select_2 required" id="ubigeodni" name="ubigeodni" required></select>
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
                                                            <input type="text" class="form-control required" value="" id="telefono_celular" name="telefono_celular" required>
                                                         </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telefono_fijo"> Telefono fijo (opcional) : </label>
                                                            <input type="text" class="form-control" value="" id="telefono_fijo" name="telefono_fijo">
                                                         </div>
                                                    </div>
                                                      
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="domicilio"> Domicilio : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control required" value="" id="domicilio" name="domicilio" required> </div>
                                                    </div>   
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ubigeo_domicilio"> Ubigeo Domicilio : <span class="text-danger">*</span> </label>
                                                            <!-- <input type="text" class="form-control required" value="" id="ubigeo_domicilio" name="ubigeo_domicilio">  -->
                                                            <select class="form-control select_2 required" id="ubigeo_domicilio" name="ubigeo_domicilio" required></select>
                                                            <div class="invalid-feedback">
                                                                Seleccione su lugar de domicilio
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card border-info border">
                                                            <div class="card-header bg-success">
                                                                <label for="cargar_dni" class="mb-0 text-white"> <i class="fa fa-upload"></i> Cargar Documento de Identidad (DNI, Carné de Extranjería, Otro)</label>
                                                            </div>
                                                            <div class="card-body"> 
                                                                <small>(Solo archivos .pdf - Tamaño máximo de archivo 5MB)</small> <input type="file" class="material-inputs form-control required" id="cargar_dni" name="cargar_dni" accept="application/pdf" required> 
                                                                <input type="hidden" id="input_hide_dni" value="0">
                                                                <span id="btn_doc_dni" class=""></span>                                                 
                                                            </div>
                                                        </div>
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
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input name="group1" value="true"  class=" group1 material-inputs required"  value="1" type="radio" id="si_discapacidad"  />
                                                            <label for="si_discapacidad">Si</label>
                                                            <input name="group1" value="false" class=" group1 material-inputs required" value="0" type="radio" id="no_discapacidad"  />
                                                            <label for="no_discapacidad">No</label>
                                                        </div>   
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <small>(Solo archivos .pdf - Tamaño máximo de archivo 5MB)</small>
                                                            <input name="file_discapacidad"  class="material-inputs" type="file" id="file_discapacidad" accept="application/pdf" />
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
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input name="group2" value="true" class="group2 material-inputs required" value="1" type="radio" id="si_ffaa"  />
                                                            <label for="si_ffaa">Si</label>
                                                            <input name="group2" value="false"  class="group2 material-inputs required" value="0" type="radio" id="no_ffaa"  />
                                                            <label for="no_ffaa">No</label>
                                                        </div>   
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <small>(Solo archivos .pdf - Tamaño máximo de archivo 5MB)</small>
                                                            <input name="file_ffaa" id="file_ffaa"  class="material-inputs" type="file" accept="application/pdf"  />
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
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input name="group3" value="true"  class=" group3 material-inputs required" type="radio" id="si_deportista"  />
                                                            <label for="si_deportista">Si</label>
                                                            <input name="group3" value="false"  class=" group3 material-inputs required" type="radio" id="no_deportista"  />
                                                            <label for="no_deportista">No</label>
                                                        </div>   
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <small>(Solo archivos .pdf - Tamaño máximo de archivo 5MB)</small>
                                                            <input name="file_deportista"  class="material-inputs" type="file" id="file_deportista" accept="application/pdf" />
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
                                                            
                                                           <button onclick="pre_guardardatos()" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" >
                                                            <i class="fa fa-plus "></i> Guardar</button>
                                                               <!--<button onclick="anios_meses_dias(365)" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" >
                                                                <i class="fa fa-plus "></i> calcular tiempo</button>-->
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div id="div_act">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <button type="button" onclick="nueva_forma();" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nueva_formacion">
                                                            <i class="fa fa-plus"></i> Nuevo</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                     
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
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <button type="button" onclick="nueva_capacitacion()" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nuevo">
                                                        <i class="fa fa-plus"></i> Nuevo</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                 
                                                    
                                                </div>
                                               
                                                  <div class="col-md-4">
                                                    
                                                    
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
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="hi-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <button type="button" onclick="nueva_expe();" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" >
                                                        <i class="fa fa-plus"></i> Nuevo</button>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                        
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        <strong>Mi Exper. General: </strong><input id="total_exp_general" name="total_exp_general" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled> 
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        <strong>Mi Exper. Específica: </strong><input id="total_exp_especifica" name="total_exp_especifica" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled> 
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
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Fin</th>
                                                            <th>Tiempo Exper.</th>
                                                            <th>Acciones</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody id="zeroconfig3_body">
                                                            <!-- Cuerpo vacio -->
                                                           
                                                    </tbody>
                                                    
                                                </table>
                                            </div>          
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                    @endif
                    
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>





@endsection
@section('js')
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <!-- <script src="{{ asset('/extra-libs/jqbootstrapvalidation/validation.js')}}"></script> -->
    <script src="{{ asset('/js/perfil_usuario.js')}}"></script>
    <script src="{{ asset('/js/moment.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{ asset('/js/ubigeo_reniec_select2.js')}}"></script>
    <script src="{{ asset('/js/update_fotografia.js')}}"></script>
{{-- Ajustes de vista --}}
@endsection
