@extends('layouts.material')

@section('css')
@endsection

@section('title','Ajustes')

@section('menu_title_1','Nombre Menu')
@section('menu_title_2','Nombre_Menu')

@section('content')
    @include('auth.m_contraseña')
    @include('postulante.modalformacion')
    @include('postulante.modalnuevacapacitacion')
    @include('postulante.modalnuevaexperiencia')
        
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-4"> <img src="{{ asset(Auth::user()->img)}}" alt="user" class="rounded-circle" width="150">
                                    <h4 class="card-title mt-2">{{auth()->user()->nombres.' '.auth()->user()->apellido_paterno.' '.auth()->user()->apellido_materno}}</h4>
                                    @foreach(auth()->user()->roles as $rol)
                                    <button class="btn waves-effect waves-light btn-rounded btn-success" disabled> {{$rol->nombre}}</button>
                                    @endforeach
                                    <!-- <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div> -->
                                </center>
                            </div>
                            <div></div>
                                <hr> 
                                <div class="card-body"> 
                                    <small class="text-muted">DNI</small> 
                                        <h6>{{auth()->user()->dni}}</h6> 
                                    <small class="text-muted">Fecha de Nacimiento</small> 
                                        <h6>fecha_nacimiento</h6> 
                                    <small class="text-muted pt-4 db">Celular</small> 
                                        <h6>telefono_celular</h6>
                                    <small class="text-muted pt-4 db">Correo</small> 
                                        <h6>{{auth()->user()->email}}</h6>  
                                    <small class="text-muted pt-4 db">Dirección</small>
                                        <h6>domicilio Calle alla sito, N° 20815</h6>
                                    <hr> 
                                    <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#m_contraseña"
                                    data-placement="bottom" title="" data-original-title="Modificar Contaseña"><i class="mdi mdi-account-key font-20"></i></button>
                                <!-- <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                                </div> 
                                    <small class="text-muted pt-4 db">Redes Sociales</small>
                                    <br>
                                    <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                    <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button> 
                                -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-9 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Datos Usuario</a>
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
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="apellido_paterno"> Apellido Paterno : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control" value="{{auth()->user()->apellido_paterno}}" id="apellido_paterno" name="apellido_paterno" disabled> </div>
                                                            
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="apellido_materno"> Apellido Materno : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control" value="{{auth()->user()->apellido_materno}}" id="apellido_materno" name="apellido_materno" disabled> </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nombres"> Nombres : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control" value="{{auth()->user()->nombres}}" id="nombres" name="nombres" disabled> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="dni"> DNI : <span class="text-danger">*</span> </label>
                                                            <input type="text" value="{{auth()->user()->dni}}" class="form-control" id="dni" name="dni" disabled> </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email"> Correo electrónico : <span class="text-danger">*</span> </label>
                                                            <input type="email" class="form-control" id="email" value="{{auth()->user()->email}}" name="email" disabled> </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento"> Fecha de nacimiento : <span class="text-danger required">*</span> </label>
                                                            <input type="date" class="form-control required" id="fecha_nacimiento" name="fecha_nacimiento" > </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                    
                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ruc"> RUC (opcional):  </label>
                                                            <input type="text" class="form-control " value=""  id="ruc" name="ruc"> </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ubigeodni"> Lugar de nacimiento : <span class="text-danger">*</span> </label>
                                                            <!-- <input type="text" class="form-control required" value="" id="ubigeodni" name="ubigeodni">  -->
                                                            <select class="form-control select_2 required" name="" id="ubigeodni" name="ubigeodni"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nacionalidad"> Nacionalidad : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control required" value="" id="nacionalidad" name="nacionalidad"> </div>
                                                    </div>   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telefono_celular"> Telefono celular : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control required" value="" id="telefono_celular" name="telefono_celular"> </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telefono_fijo"> Telefono fijo (opcional) : </label>
                                                            <input type="text" class="form-control" value="" id="telefono_fijo" name="telefono_fijo"> </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ubigeo_domicilio"> Ubigeo Domicilio : <span class="text-danger">*</span> </label>
                                                            <!-- <input type="text" class="form-control required" value="" id="ubigeo_domicilio" name="ubigeo_domicilio">  -->
                                                            <select class="form-control select_2 required" id="ubigeo_domicilio" name="ubigeo_domicilio"></select>
                                                        </div>
                                                    </div>   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="domicilio"> Domicilio : <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control required" value="" id="domicilio" name="domicilio"> </div>
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
                                                            <input name="file_discapacidad"  class="material-inputs" type="file" id="file_discapacidad" accept="application/pdf" />
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
                                                            <input name="file_ffaa" id="file_ffaa"  class="material-inputs" type="file" accept="application/pdf"  />
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
                                                            <input name="file_deportista"  class="material-inputs" type="file" id="file_deportista" accept="application/pdf" />
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
                                                            
                                                           <button onclick="guardardatos()" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" >
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
                                                        <strong>Mi Exper. General: </strong><input id="total_exp_general" name="total_exp_general" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled id="horas_cap_ind"> 
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        <strong>Mi Exper. Específica: </strong><input id="total_exp_especifica" name="total_exp_especifica" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled id="horas_cap_ind"> 
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
    <script src="{{ asset('/extra-libs/jqbootstrapvalidation/validation.js')}}"></script>
    <script src="{{ asset('/js/perfil_usuario.js')}}"></script>
    <script src="{{ asset('/js/moment.min.js')}}"></script>
{{-- Ajustes de vista --}}
@endsection
