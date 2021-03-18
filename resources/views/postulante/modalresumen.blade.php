<!-- Full width modal content -->
<div id="modal_resumen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="header-formacion" class="modal-header bg-warning">
                <h4 class="modal-title text-black text-center  font-weight-bold" id="fullWidthModalLabel">FORMATO DE HOJA DE VIDA </h4>
                <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">×</button>
            </div>
            {{-- wizard --}}
            <div class="modal-body">
                <!-- Inicio  Acordion---------->
                <div class="card col-md-12">                        
                    <div class="row">
                        <div class="card-body form-row ">                                    
                            <div class="col-2 border form-group alert-warning">
                                <img src="{{ asset(Auth::user()->img)}}" alt="user" width="80">
                            </div>
                            <div class="col-5 border form-group alert-warning">
                                <small class="text-center text-dark-info font-weight-bold "><strong>PROCESO: </strong></small> <br>{{$proceso->cod}}                                                
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
                    <!-- INICIO ACORDION ....NO DA :'( 
                    <button class="accordion">I. DATOS PERSONALES</button>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <button class="accordion">Section 2</button>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <button class="accordion">Section 3</button>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                        FIIIN -->

                    <!-- ACORDION 2-->
                    <div id="accordion">
                        <!-- 1ro -->
                        <div class="card">
                            <div class="card-header bg-warning" id="headingOne">
                                <button class="btn text-dark text-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>I. DATOS PERSONALES</strong> 
                                    <i class="fa fa-arrow-circle-right text-dark align-items-center" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="table-responsive border border-warning">
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
                                                <td>{{auth()->user()->dni}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="alert alert-secondary">Fecha de Nacimiento</th>
                                                <td>{{auth()->user()->dni}}</td>
                                                <th scope="row" class="alert alert-secondary">Dist.-Prov.-Dep:</th>
                                                <td>{{auth()->user()->dni}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="alert alert-secondary">Celular N° </th>
                                                <td>{{auth()->user()->dni}}</td>
                                                <th scope="row" class="alert alert-secondary">Correo Electrónico</th>
                                                <td>{{auth()->user()->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="alert alert-secondary">Dirección Actual </th>
                                                <td>{{auth()->user()->dni}}</td>
                                                <th scope="row" class="alert alert-secondary">Dist.-Prov.-Dep:</th>
                                                <td>{{auth()->user()->dni}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="4" class=""></th>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">¿Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N° 29973) </th>
                                                <td>{{auth()->user()->dni}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">¿Es licenciado de las FFAA ? (Ley Nº 29248) </th>
                                                <td>{{auth()->user()->dni}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">¿Es deportista calificado? </th>
                                                <td>{{auth()->user()->dni}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--2do -->
                        <div class="card">
                            <div class="card-header bg-warning" id="headingTwo">
                                <button class="btn text-dark text-center collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong>II. FORMACIÓN ACADEMICA</strong> 
                                    <i class="fa fa-arrow-circle-right text-dark align-items-center" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="table-responsive border border-warning">
                                    <table id="zeroconfig1" class="table table-striped table-bordered">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th>Grado de estudio</th>
                                                <th>Especialidad</th>
                                                <th>Centro de Estudios</th>
                                                <th>Fecha Expedición</th>
                                            </tr>
                                        </thead>
                                        <tbody id="zeroconfig1_body">                                                        
                                        </tbody>                                                
                                        <tfoot>
                                        </tfoot>                                            
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- 3ro -->
                        <div class="card">
                            <div class="card-header bg-warning" id="headingThree">
                                <button class="btn text-dark text-center collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>III. CURSOS Y/O ESPECIALIZACIONES</strong> 
                                    <i class="fa fa-arrow-circle-right text-dark align-items-center" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="table-responsive border border-warning">
                                    <table id="zero_config2" class="table table-striped table-bordered">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th>Tipo de estudio</th>
                                                <th>Descripción</th>
                                                <th>Institución</th>
                                                <th>Horas lectivas<br></th>                                                    
                                            </tr>
                                        </thead>
                                        <tbody id="zeroconfig2_body">
                                                <!-- Cuerpo vacio -->                                                
                                        </tbody>                                            
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--4to -->
                        <div class="card">
                            <div class="card-header bg-warning" id="heading4">
                                <button class="btn text-dark text-center collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    <strong>IV. EXPERIENCIA LABORAL</strong> 
                                    <i class="fa fa-arrow-circle-right text-dark align-items-center" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
                                <div class="table-responsive border border-warning">
                                    <table id="zero_config3" class="table table-striped table-bordered">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th>Tipo de Experiencia</th>
                                                <th>Es experiencia</th>                                                    
                                                <th>Nombre Entidad</th>
                                                <th>Cargo<br></th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Tiempo Exper.</th>                                                  
                                            </tr>
                                        </thead>
                                        <tbody id="zeroconfig3_body">
                                                <!-- Cuerpo vacio -->                                                
                                        </tbody>                                            
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- 5TO--> 
                        <div class="card">
                            <div class="card-header bg-warning" id="heading5">
                                <button class="btn text-dark text-center collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    <strong>V. DECLARACIÓN JURADA</strong> 
                                    <i class="fa fa-arrow-circle-right text-dark align-items-center" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
                                <div class="table-responsive border border-warning">
                                    <table id="zero_config3" class="table table-striped table-bordered">
                                        <thead>
                                            <th colspan="3"></th>
                                            <th>Respuesta</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">1. Me encuentro inhabilitado administrativa o judicialmente para contratar con el Estado. </th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">2. Me encuentro inmerso en algún Proceso Administrativo Disciplinario, o he sido destituido de la Administración Pública.  </th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">3. Tengo antecedentes penales, judiciales y/o policiales. </th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">4. Tengo impedimento para ser postor o contratista, conforme a lo establecido en el marco normativo que regula las contrataciones y adquisiciones del Estado.</th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">5. Me une algún vínculo familiar y/o matrimonial hasta el cuarto grado de consanguinidad, segundo de afinidad con los funcionarios, directivos de la Universidad Nacional “Hermilio Valdizán” de Huánuco y con los miembros del Comisión de Concurso Público para Contrato Administrativo de Servicios - CAS {{$proceso->cod}}</th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">6. Percibo otro ingreso tipo de remuneración por parte del Estado o de alguna naturaleza.</th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">7. Percibo alguna pensión a cargo del Estado.</th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">8. Soy deudor Alimentario Moroso y/o me encuentro inscrito en el Registro de Deudores Alimentarios de Morosos (REDAM), conforme a lo dispuesto por la Ley Nº28970.</th>
                                                <td>Siiii</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="alert alert-secondary">9. Los documentos que declaro y presento son verídicos y fidedignos.</th>
                                                <td>Siiii</td>
                                            </tr>
                                        <tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--FIN 5TO -->
                    </div> 
                    <div class="card-body">
                        <div id="veracidad" class="row card-body border alert alert-success" >          
                            <div class="col-md-1 text-center justify-content-center align-items-center" >
                                <input style="width: 20px; height: 20px" id="check_dj" name="check_dj" value="1" type="checkbox" />
                            </div>                         
                            <div class="col-md-11">
                                <h5>Manifiesto que lo mencionado en la presente Declaración Jurada, responde al principio de veracidad normado en el numeral 1.7 del artículo IV del Título Preliminar, y el artículo 42º de la Ley Nº 27444 “Ley del Procedimiento Administrativo General”; así mismo tengo pleno conocimiento que si incurro en una declaración falsa, estoy sujeto a las sanciones previstas en el artículo 411º del Código Penal vigente.</h5>  
                            </div>                             
                        </div>
                    </div>                                       
                </div>
                <!-- Fin  Acordion---------->                      
                <br>
                <br> 
            </div>
            {{-- wizard FIN--}}             
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div> 
        </div>    
    </div>
</div>
 