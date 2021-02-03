@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->

<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection

@section('content')
<!--{{auth()->user()->nombres}} <br>
{{auth()->user()->id}} <br>
{{auth()->user()->email}} <br>-->
<!-- ============================================================== -->
<!-- Example -->
<!-- ============================================================== -->
@include('postulante.modalformacion')
@include('postulante.modalnuevacapacitacion')
@include('postulante.modalnuevaexperiencia')

<div class="col-12">
    <div class="card">
        <div class="alert alert-info" role="alert">
            <i class="dripicons-information mr-5"></i>  <strong> <h2 class="text-center text-info">
            @foreach ($proceso as $pro)
            {{$pro->cod}} - {{$pro->nombre}} (N° plazas = {{$pro->n_plazas}})
            @endforeach    
            </h2></strong> 
            
        </div>
        <div class="card-body wizard-content">
            
            <form action="#" class="validation-wizard wizard-circle mt-5">
                <!-- Step 1 -->
                <h6>Datos Personales</h6>
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_paterno"> Apellido Paterno : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_materno"> Apellido Materno : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombres"> Nombres : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="nombres" name="nombres"> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dni"> DNI : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="dni" name="dni"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email"> Correo electrónico : <span class="danger">*</span> </label>
                                <input type="email" class="form-control" id="email" name="email"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_nacimiento"> Fecha de nacimiento : <span class="danger">*</span> </label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ruc"> RUC : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="ruc" name="ruc"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_paterno"> Ubigeo segun DNI : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido_materno"> Nacionalidad : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno"> </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono_celular"> Telefono celular : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="telefono_celular" name="telefono_celular"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono_fijo"> Telefono fijo : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="domicilio"> Domicilio : <span class="danger">*</span> </label>
                                <input type="text" class="form-control" id="domicilio" name="domicilio"> </div>
                        </div>   
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label > ¿Cuenta con certificado de discapacidad y/o registro en CONADIS?(Ley N° 29973) <span class="danger">*</span> </label>
                                
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="group1"  class="material-inputs" type="radio" id="si_discapacidad"  />
                                <label for="si_discapacidad">Si</label>
                                <input name="group1"  class="material-inputs" type="radio" id="no_discapacidad"  />
                                <label for="no_discapacidad">No</label>
                            </div>   
                        </div>
                                             
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label > ¿Es licenciado de las FFAA ?(Ley Nº 29248) <span class="danger">*</span> </label>
                                
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="group2"  class="material-inputs" type="radio" id="si_ffaa"  />
                                <label for="si_ffaa">Si</label>
                                <input name="group2"  class="material-inputs" type="radio" id="no_ffaa"  />
                                <label for="no_ffaa">No</label>
                            </div>   
                        </div>
                                             
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label > ¿Es deportista calificado? <span class="danger">*</span> </label>
                                
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input name="group3"  class="material-inputs" type="radio" id="si_deportista"  />
                                <label for="si_deportista">Si</label>
                                <input name="group3"  class="material-inputs" type="radio" id="no_deportista"  />
                                <label for="no_deportista">No</label>
                            </div>   
                        </div>
                                             
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <label> (*) Indica un campo obligatorio.<span class="danger"></span> </label>
                        </div>
                        
                    <br>
                    <br>

                   
                </section>
                <!-- Step 2 -->
                <h6>Formación Académica</h6>
                <section>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nueva_formacion">
                                <i class="fa fa-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        
                    </div>                    
                    <div class="table-responsive">
                        <table id="zero_config1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tipo de estudios</th>
                                    <th>Descripción</th>
                                    <th>Centro de Estudios</th>
                                    <th>Especialidad<br></th>
                                    <th>Cantidad de Horas</th>
                                    <th>Documento</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <!-- Cuerpo vacio -->
                                    <tr>
                                        <td>Curso</td>
                                        <td>Redes</td>
                                        <td>Universidad Nacional Hermilio Valdizan</td>
                                        <td>Espcialidad</td>
                                        <td>80</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Curso</td>
                                        <td>Redes</td>
                                        <td>Universidad Nacional Hermilio Valdizan</td>
                                        <td>Espcialidad</td>
                                        <td>80</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tipo de estudios</th>
                                    <th>Descripción</th>
                                    <th>Centro de Estudios</th>
                                    <th>Especialidad<br></th>
                                    <th>Cantidad de Horas</th>
                                    <th>Documento</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                                        
                </section>
                
                <!-- Step 3 -->
                <h6>Cursos y/o Especializaciones</h6>
                <section>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nuevo">
                                <i class="fa fa-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-inline">
                              <label for="total_horas">Total horas: <span class="danger"></span> </label>
                              <input type="text" readonly="readonly" class="form-control" id="total_horas" name="total_horas" > 
                          </div>
                      </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="zero_config2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tipo de estudios</th>
                                    <th>Descripción</th>
                                    <th>Centro de Estudios</th>
                                    <th>Especialidad<br></th>
                                    <th>Cantidad de Horas</th>
                                    <th>Documento</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <!-- Cuerpo vacio -->
                                    <tr>
                                        <td>Curso</td>
                                        <td>Redes</td>
                                        <td>Universidad Nacional Hermilio Valdizan</td>
                                        <td>Espcialidad</td>
                                        <td>80</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Curso</td>
                                        <td>Redes</td>
                                        <td>Universidad Nacional Hermilio Valdizan</td>
                                        <td>Espcialidad</td>
                                        <td>80</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tipo de estudios</th>
                                    <th>Descripción</th>
                                    <th>Centro de Estudios</th>
                                    <th>Especialidad<br></th>
                                    <th>Cantidad de Horas</th>
                                    <th>Documento</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                                        
                </section>
                
                <!-- Step 4 -->
                <h6>Experiencia Laboral</h6>
                <section>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info" data-toggle="modal" data-target="#modal_nueva_experiencia">
                                <i class="fa fa-plus"></i> Nuevo</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-inline">
                                <label for="exp_general">Experiencia General:<span class="danger"></span> </label>
                                <input type="text" readonly="readonly" class="form-control " id="exp_general" name="exp_general" > 
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-inline">
                              <label for="exp_especifica">Experiencia Específica:<span class="danger"></span> </label>
                              <input type="text" readonly="readonly" class="form-control " id="exp_especifica" name="exp_especifica" > 
                          </div>
                      </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="zero_config3" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tipo de estudios</th>
                                    <th>Descripción</th>
                                    <th>Centro de Estudios</th>
                                    <th>Especialidad<br></th>
                                    <th>Cantidad de Horas</th>
                                    <th>Documento</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <!-- Cuerpo vacio -->
                                    <tr>
                                        <td>Curso</td>
                                        <td>Redes</td>
                                        <td>Universidad Nacional Hermilio Valdizan</td>
                                        <td>Espcialidad</td>
                                        <td>80</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Curso</td>
                                        <td>Redes</td>
                                        <td>Universidad Nacional Hermilio Valdizan</td>
                                        <td>Espcialidad</td>
                                        <td>80</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tipo de estudios</th>
                                    <th>Descripción</th>
                                    <th>Centro de Estudios</th>
                                    <th>Especialidad<br></th>
                                    <th>Cantidad de Horas</th>
                                    <th>Documento</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                                        
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

<script>
    //Vertical Steps
    
    $("#example-vertical").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical"
    });
    
    //Custom design form example
    $(".tab-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onFinished: function(event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
    
        }
    });
    
    
    var form = $(".validation-wizard").show();
    
    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        },
        onFinishing: function(event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    }), $(".validation-wizard").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })

    $(document).ready( function () {
    $('#zero_config1').DataTable();
    $('#zero_config2').DataTable();
    $('#zero_config3').DataTable();
} );
    </script>
@endsection
