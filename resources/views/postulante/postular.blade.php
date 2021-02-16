@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->

<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endsection

@section('content')



@include('postulante.modalformacion')
@include('postulante.modalnuevacapacitacion')
@include('postulante.modalnuevaexperiencia')


<div class="col-12">
    <div class="card">
        <div class="alert alert-info" role="alert">
            <i class="dripicons-information mr-5"></i>  <strong> <h2 class="text-center text-dark-info font-weight-bold ">
            @foreach ($proceso as $pro)
            <div><input type="hidden" value="{{$proceso}}"  id="cod" ><i class="fas fa-angle-double-right mr-2"></i>{{$pro->cod}} - {{$pro->nombre}} <i class="fas fa-users mr-2 ml-5"></i><small>N° Plazas = {{$pro->n_plazas}}</small></div>
            @endforeach     
            </h2></strong> 
            
        </div>
        <div class="card-body wizard-content">
            
            <form  id="datospostulante" class="validation-wizard wizard-circle mt-5">
                @csrf
                <!-- Step 1 -->
                <h6>Datos Personales</h6>
                <section id="section1">
                    <div >
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
                                    <label for="fecha_nacimiento"> Fecha de nacimiento : <span class="text-danger">*</span> </label>
                                    <input type="date" class="form-control required" id="fecha_nacimiento" name="fecha_nacimiento" > </div>
                            </div>
                        </div>
                        
                        
                            
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ruc"> RUC : <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control required" value=""  id="ruc" name="ruc"> </div>
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
                                    <label for="telefono_fijo"> Telefono fijo : <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control required" value="" id="telefono_fijo" name="telefono_fijo"> </div>
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
                                    <input name="file_discapacidad"  class="material-inputs" type="file" id="file_discapacidad"  />
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
                                    <input name="file_ffaa" id="file_ffaa"  class="material-inputs" type="file"  />
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
                                    <input name="file_deportista"  class="material-inputs" type="file" id="file_deportista" />
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
                        <div class="col-md-8">
                            <div class="form-group">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nueva_formacion">
                                <i class="fa fa-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @foreach ($proceso_formacion as $item)
                            <div class="alert alert-danger" role="alert">
                                <strong>Formación requerida: </strong> {{$item->nombre}}
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
                 <br><br><br>                 
                </section>
                
                <!-- Step 3 -->
                <h6>Cursos y/o Especializaciones</h6>
                <section id="section3">
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nuevo">
                                <i class="fa fa-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="alert alert-success text-center" role="alert">
                                <strong>Mí total de Hrs: </strong><input id="total_horas" name="total_horas" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled id="horas_cap_ind" value="{{$item->horas_cap_ind.' Hrs'}}"> 
                            </div>
                            
                        </div>
                       
                          <div class="col-md-4">
                            @foreach ($proceso as $item)
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>Mínimo de horas por curso/capa.: </strong><input class=" border-0 bg-light-danger text-dark-danger text-center" type="text" disabled id="horas_cap_ind" value="{{$item->horas_cap_ind.' Hrs'}}"> 
                            </div>
                            @endforeach
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" onclick="nueva_expe();" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" >
                                <i class="fa fa-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="alert alert-success text-center" role="alert">
                                <strong>Mi Exper. General: </strong><input id="total_exp_general" name="total_exp_general" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled id="horas_cap_ind"> 
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success text-center" role="alert">
                                <strong>Mi Exper. Específica: </strong><input id="total_exp_especifica" name="total_exp_especifica" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled id="horas_cap_ind"> 
                            </div>

                          
                      </div>
                      <div class="col-md-4">
                        @foreach ($proceso as $item)
                        <div class="alert alert-danger" role="alert">
                            <strong>Exper. General mínima: </strong> {{$item->anios_exp_lab_gen}}  <br>
                            <strong>Exper. Específica mínima: </strong> {{$item->anios_exp_lab_esp}}
                        </div>
                        @endforeach
                      </div>
                      
                    </div>
                   
                    
                    <div class="table-responsive">
                        <table id="zero_config3" class="table table-striped table-bordered">
                            <thead class="text-white bg-info">
                                <tr>
                                    <th>Tipo de Experiencia</th>
                                    <th>Es experiencia</th>
                                    <th>Tipo Entidad</th>
                                    <th>Nombre Entidad</th>
                                    <th>Cargo<br></th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Documento</th>
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
                <h6>POSTULAR</h6>
                <section>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-right">
                                <label class="text-md-right text-right"> Declaración jurada <span class="text-danger">*</span> </label>
                                
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input name=""  class="material-inputs"  type="file"/>
                            </div>   
                        </div>
                                             
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-right">
                                <label class="text-md-right " > Anexo 1 <span class="text-danger">*</span> </label>
                                
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <input name=""  class="material-inputs"  type="file"  />
                            </div>   
                        </div>
                                             
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-right">
                                <label class="text-right"> Anexo 2 <span class="text-danger">*</span> </label>
                                
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input name=""  class="material-inputs"  type="file"   />
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
@endsection

