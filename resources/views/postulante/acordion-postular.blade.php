
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header2" data-toggle="collapse" data-target="#collapse-i" aria-expanded="true">
                <h2 class="mb-0">
                    <button class="btn btn-block btn-accordion active" type="button">
                        I. DATOS PERSONALES
                    </button>
                </h2>
            </div>

            <div id="collapse-i" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="alert alert-secondary">Apellidos y Nombres</th>
                                                    <td >{{auth()->user()->apellido_paterno}} {{auth()->user()->apellido_materno}}, {{auth()->user()->nombres}}</td>
                                                    <th scope="row" class="alert alert-secondary">Documentos de Identidad</th>
                                                    <td>{{auth()->user()->dni}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="alert alert-secondary">RUC:</th>
                                                    <td id="res_ruc"></td>
                                                    <th scope="row" class="alert alert-secondary">Fecha de Nacimiento</th>
                                                    <td id="res_fecha_nac"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="alert alert-secondary">Nacionalidad</th>
                                                    <td id="res_nacionalidad"></td>
                                                    <th scope="row" class="alert alert-secondary">Lugar de Nacimiento:</th>
                                                    <td id="res_ubigeo_nac"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="alert alert-secondary">Celular N?? </th>
                                                    <td id="res_celular"></td>
                                                    <th scope="row" class="alert alert-secondary">Correo Electr??nico</th>
                                                    <td>{{auth()->user()->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="alert alert-secondary">Direcci??n Actual </th>
                                                    <td colspan="3" id="res_direccion"></td>
                                                    
                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="4" class=""></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3" class="alert alert-secondary">??Cuenta con certificado de discapacidad y/o registro en CONADIS? (Ley N?? 29973) </th>
                                                    <td id="res_disc"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3" class="alert alert-secondary">??Es licenciado de las FFAA ? (Ley N?? 29248) </th>
                                                    <td id="res_ffaa"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3" class="alert alert-secondary">??Es deportista calificado? </th>
                                                    <td id="res_depor"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header2" data-toggle="collapse" data-target="#collapse-ii" aria-expanded="false">
                <h2 class="mb-0">
                    <button class="btn btn-block btn-accordion" type="button">
                    II. FORMACI??N ACADEMICA
                    </button>
                </h2>
            </div>
            <div id="collapse-ii" class="collapse" data-parent="#accordionExample">
                <div class="row card-body">
                    <div class="col-md-5 alert alert-dark-info" >          
                        <div id="dato_colegiado"></div>          
                    </div>
                    <div class="col-md-3 alert alert-dark-info">
                        <span id="btn_doc_colegiatura2" class=""></span>
                    </div>                           
                </div>
                    <table  class="table table-striped table-bordered">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Grado de estudio</th>
                                <th>Especialidad</th>
                                <th>Centro de Estudios</th>
                                <th>Fecha Expedici??n</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody id="res_tbl_form">                                                        
                        </tbody>                                                
                        <tfoot>
                        </tfoot>                                            
                    </table>
                </div>
            </div>
            
        </div>
        <div class="card">
            <div class="card-header2" data-toggle="collapse" data-target="#collapse-iii" aria-expanded="false">
                <h2 class="mb-0">
                    <button class="btn btn-block btn-accordion" type="button">
                        III. CURSOS Y/O ESPECIALIZACIONES
                    </button>
                </h2>
            </div>
            <div id="collapse-iii" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Tipo de estudio</th>
                                <th>Descripci??n</th>
                                <th>Instituci??n</th>
                                <th>Horas lectivas</th>
                                <th>Ver</th> 
                            </tr>
                        </thead>
                        <tbody id="res_tbl_capa">
                                <!-- Cuerpo vacio -->                                                
                        </tbody>                                            
                    </table>
                </div>
            </div>
            
        </div>
        <div class="card">
            <div class="card-header2" data-toggle="collapse" data-target="#collapse-iv" aria-expanded="false">
                <h2 class="mb-0">
                    <button class="btn btn-block btn-accordion" type="button">
                        IV. EXPERIENCIA LABORAL
                    </button>
                </h2>
            </div>
            <div id="collapse-iv" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    <table  class="table table-striped table-bordered">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Tipo de Experiencia</th>
                                <th>Es experiencia</th>                                                    
                                <th>Nombre Entidad</th>
                                <th>Cargo<br></th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Tiempo Exper.</th>
                                <th>Ver</th>                                                  
                            </tr>
                        </thead>
                        <tbody id="res_tbl_exp">
                                <!-- Cuerpo vacio -->                                                
                        </tbody>                                            
                    </table>
                </div>
            </div>
            
        </div>
        <div class="card">
            <div class="card-header2" data-toggle="collapse" data-target="#collapse-v" aria-expanded="false">
                <h2 class="mb-0">
                    <button class="btn btn-block btn-accordion" type="button">
                    V. DECLARACI??N JURADA
                    </button>
                </h2>
            </div>
            <div id="collapse-v" class="collapse" data-parent="#accordionExample">
                <div class="card-body">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <th colspan="3">Descripci??n</th>
                            <th>Respuesta</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">1. Me encuentro inhabilitado administrativa o judicialmente para contratar con el Estado. </th>
                                <td id="res_dj1"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">2. Me encuentro inmerso en alg??n Proceso Administrativo Disciplinario, o he sido destituido de la Administraci??n P??blica.  </th>
                                <td id="res_dj2"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">3. Tengo antecedentes penales, judiciales y/o policiales. </th>
                                <td id="res_dj3"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">4. Tengo impedimento para ser postor o contratista, conforme a lo establecido en el marco normativo que regula las contrataciones y adquisiciones del Estado.</th>
                                <td id="res_dj4"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">5. Me une alg??n v??nculo familiar y/o matrimonial hasta el cuarto grado de consanguinidad, segundo de afinidad con los funcionarios, directivos de la Universidad Nacional ???Hermilio Valdiz??n??? de Hu??nuco y con los miembros del Comisi??n de Concurso P??blico para Contrato Administrativo de Servicios - {{$proceso->cod}}</th>
                                <td id="res_dj5"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">6. Percibo otro ingreso tipo de remuneraci??n por parte del Estado o de alguna naturaleza.</th>
                                <td id="res_dj6"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">7. Percibo alguna pensi??n a cargo del Estado.</th>
                                <td id="res_dj7"></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="3" class="alert alert-secondary">8. Soy deudor Alimentario Moroso y/o me encuentro inscrito en el Registro de Deudores Alimentarios de Morosos (REDAM), conforme a lo dispuesto por la Ley N??28970.</th>
                                <td id="res_dj8"></td>
                            </tr>
                            
                        <tbody> 
                    </table>
                </div>
            </div>
        </div>
    </div>