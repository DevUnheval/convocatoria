
<!--  Modal content for the above example -->
<div class="modal fade" id="modal_cv" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">Curriculum Vitae</h4>
                <button type="button" class="close ml-auto" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
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
                                           
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Apellidos y Nombres</th>
                                                        <td colspan="3">{{auth()->user()->apellido_paterno}} {{auth()->user()->apellido_materno}}, {{auth()->user()->nombres}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Documentos de Identidad</th>
                                                        <td>{{auth()->user()->dni}}</td>
                                                        <th scope="row" class="alert alert-secondary">RUC:</th>
                                                        <td id="res_ruc"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Fecha de Nacimiento</th>
                                                        <td id="res_fecha_nac"></td>
                                                        <th scope="row" class="alert alert-secondary">Dist.-Prov.-Dep:</th>
                                                        <td id="res_ubigeo_nac"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Celular N° </th>
                                                        <td id="res_celular"></td>
                                                        <th scope="row" class="alert alert-secondary">Correo Electrónico</th>
                                                        <td>{{auth()->user()->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Dirección Actual </th>
                                                        <td id="res_direccion"></td>
                                                        <th scope="row" class="alert alert-secondary">Dist.-Prov.-Dep:</th>
                                                        <td id="res_ubigeo_direc"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="4" class=""></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3" class="alert alert-secondary">¿Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N° 29973) </th>
                                                        <td id="res_disc"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3" class="alert alert-secondary">¿Es licenciado de las FFAA ? (Ley Nº 29248) </th>
                                                        <td id="res_ffaa"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3" class="alert alert-secondary">¿Es deportista calificado? </th>
                                                        <td id="res_depor"></td>
                                                    </tr>
                                                </tbody>
                                            </table> 
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->