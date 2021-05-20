<!--  Modal content for the above example -->
<div class="modal fade" id="modal_cv" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">
                    <a href="#" title="clic para descargar" id="ruta_cv_postulante" target="_blank"> 
                        <span class="text-white bg-info pl-3 pr-3 pt-2 pb-2 mr-3">
                            <i class="fa fa-download"></i> CURRICULUM VITAE
                        </span>
                    </a>
                    <a href="#" title="clic para descargar" id="ruta_cv_postulante2" target="_blank"> 
                        <span class="text-white bg-info pl-3 pr-3 pt-2 pb-2 mr-3">
                            <i class="fa fa-download"></i> CV2
                        </span>
                    </a>
                    <span id="postulante" class="ml-2 mr-2"></span>
                    <span id="dnicab" ></span>
                </h4>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div>
                @if($etapa_actual['etapa']=='1')
                <div class="justify-content-right p-1 offset-sm-8 col-sm-4"  style="height: 100px; background-color: rgba(247, 220, 111,0.3);">
                    <button type="button" class="btn btn-success float-right w-50 btn_guardar_evaluacion" id="btn_guardar_evaluacion_cv" 
                        data-id_formulario="form_ev_curricular_1">Guardar  <i class=" far fa-save"></i></button>
                    <form id="form_ev_curricular_1" action="javascript:void(0);">     
                        <input class="w-50 form-control float-right" id="input_puntaje_curricular_1" type="number" placeholder="Puntaje"min="0" max="{{$proceso->$ptj_max}}" required/>
                        <textarea class="form-control float-right"   id="textarea_puntaje_curricular_1" placeholder="No hay observaciones..."></textarea>
                    </form>
                </div>
                @endif
            </div>
            <div class="modal-body">
                 <!-- Column -->
                 <div class="col-lg col-xlg col-md">
                    <div class="card">
                        <!-- Tabs -->
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true"><strong> DATOS PERSONALES</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false"><strong>FORMACIÓN ACADÉMICA</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false"><strong>CURSOS/CAPACITACIONES</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#hi-month" role="tab" aria-controls="pills-setting" aria-selected="false"><strong>EXPERIENCIA LABORAL</strong></a>
                            </li>
                        </ul>
                        <!-- Tabs -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                <div class="card-body">
                                    <!-- <form class="form-horizontal form-material"> -->
                                        
                                        <div class="card-body">
                                           
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td rowspan="6"><center><br><img id="foto_perfil" src="{{asset('/imagenes/users/user.png')}}" alt="usuario" class="rounded-circle" width="150" height="150"></center></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Apellidos y Nombres</th>
                                                        <td id="apellidosynombres"></td>
                                                        <th scope="row" class="alert alert-secondary">Documentos de Identidad</th>
                                                        <td id="dni"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">RUC:</th>
                                                        <td id="res_ruc"></td>
                                                        <th scope="row" class="alert alert-secondary">Fecha de Nacimiento</th>
                                                        <td id="res_fecha_nac"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Nacionalidad:</th>
                                                        <td id="res_nacionalidad"></td>
                                                        <th scope="row" class="alert alert-secondary">Lugar de Nacimiento:</th>
                                                        <td id="res_ubigeo_nac"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Celular N° </th>
                                                        <td id="res_celular"></td>
                                                        <th scope="row" class="alert alert-secondary">Correo Electrónico</th>
                                                        <td id="email"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="alert alert-secondary">Dirección Actual </th>
                                                        <td colspan="3" id="res_direccion"></td>
                                                        
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="5" class=""></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3" class="alert alert-secondary">¿Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N° 29973) </th>
                                                        <td colspan="2" id="res_disc"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3" class="alert alert-secondary">¿Es licenciado de las FFAA ? (Ley Nº 29248) </th>
                                                        <td colspan="2" id="res_ffaa"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3" class="alert alert-secondary">¿Es deportista calificado? </th>
                                                        <td colspan="2" id="res_depor"></td>
                                                    </tr>
                                                </tbody>
                                            </table> 
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    <!-- <form class="form-horizontal form-material"> -->
                                        
                                        <div id="div_act">
                                                               
                                            <div class="table-responsive">
                                                <div class="card-body">
                                                    <div class="row" >
                                                        <div class="col-md-5 alert alert-dark-info">
                                                             <div id="dato_colegiado">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 alert alert-dark-info">
                                                            <span id="btn_doc_colegiatura" class=""></span>
                                                        </div>
                                                                  
                                                    </div>                           
                                                </div>

                                                <table id="zeroconfig1" class="table table-striped table-bordered">
                                                    <thead class="text-white bg-info">
                                                        <tr>
                                                            <th>Grado de estudio</th>
                                                            <th>Especialidad</th>
                                                            <th>Centro de Estudios</th>
                                                            <th>Fecha Expedición</th>
                                                            <th>Ver documento</th>
                                                            <th>Validar</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                            <tbody id="tbl_cv2">
                                                                
                                                            </tbody>
                                                        
                                                    <tfoot>
                        
                                                    </tfoot>
                                                    
                                                </table>
                                            </div>
                                         </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                
                                <div class="card-body">
                                    <!-- <form class="form-horizontal form-material"> -->
                                        
                                        <br>
                                        
                                        <div class="table-responsive">
                                            <table id="zero_config2" class="table table-striped table-bordered">
                                                <thead class="text-white bg-info">
                                                    <tr>
                                                        <th>Tipo de estudio</th>
                                                        <th>Descripción</th>
                                                        <th>Institución</th>
                                                        <th>Horas lectivas<br></th>
                                                        <th>Ver documento</th>
                                                        <th>Validar</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_cv3">
                                                        <!-- Cuerpo vacio -->
                                                       
                                                </tbody>
                                                
                                            </table>
                                        </div>    
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="hi-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                
                                <div class="card-body">
                                    <!-- <form class="form-horizontal form-material"> -->
                                        
                                       
                                        <div class="row">
                                                
                                            <div class="col-md-6">
                                                <div class="alert alert-success text-center" role="alert">
                                                    <input type="hidden" id="hidden_expgen_t" value="0">
                                                    <strong>Exper. General Validada: </strong><br><input id="total_exp_general" name="total_exp_general" value="0" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled > 
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="alert alert-success text-center" role="alert">
                                                    <input type="hidden" id="hidden_expesp_t" value="0">
                                                    <strong>Exper. Específica Validada: </strong><br><input id="total_exp_especifica" name="total_exp_especifica" value="0" class=" border-0 bg-light-success text-black-50 text-center" type="text" disabled > 
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
                                                        <th>Fecha Inicio/Fin<br><small>(Año-Mes-Dia)</small></th>
                                                        <th>Funciones<br></th>
                                                        <th>Tiempo Exper.</th>
                                                        <th>Ver</th>
                                                        <th>Validar</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_cv4">
                                                        <!-- Cuerpo vacio -->
                                                       
                                                </tbody>
                                                
                                            </table>
                                        </div>          
                                    <!-- </form> -->
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