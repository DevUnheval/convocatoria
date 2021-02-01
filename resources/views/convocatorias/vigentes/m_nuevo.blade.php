<!-- Full width modal content -->
<div id="modal_nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header bg-success" >
               <h4 class="modal-title text-white"id="fullWidthModalLabel">Nuevo registro</h4>
               <button type="button" class="close" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
             {{-- wizard --}}
                 <!-- ============================================================== -->
                    <!-- Example -->
                    <!-- ============================================================== -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <!--<h4 class="card-title">Step wizard with validation</h4>
                                <h6 class="card-subtitle">You can us the validation like what we did</h6>
                                -->
                                <form action="#" class="tab-wizard wizard-circle" id="nueva_convocatoria">
                                    <!-- Step 1 -->
                                    <h6><strong>Datos generales</strong></h6>
                                    <section>
                                        <div class="row form-group mb-0 py-2 bg-light">                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <b><small for="wfirstName2">Código de la convocatoria:<span class="text-danger"> *</span> </small></b>
                                                    <input type="text" class="form-control required" id="wfirstName2" name="firstName">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small for="wlastName2">Tipo de Proceso: <span class="text-danger"> *</span> </small>
                                                    <select class="custom-select form-control" id="location1" name="location">
                                                        <option value="*Seleccione*"></option>
                                                        <option value="Amsterdam">CAS/1057</option>
                                                        <option value="Frankfurt">Prácticas</option>
                                                        <option value="Berlin">276</option>
                                                        <option value="Frankfurt">728</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Cantidad de plazas:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName">
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="row form-group border-bottom mb-0 py-1 bg-light">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="wemailAddress2">Nombre/Cargo de la convocatoria:<span class="text-danger"> *</span> </small>
                                                    <input type="text" class="form-control required" id="wemailAddress2" name="emailAddress" placeholder=""> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="wphoneNumber2">Area/Unidad al que postula:<span class="text-danger"> *</span> </small>
                                                    <input type="text" class="form-control required" id="wphoneNumber2" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Bases:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Resolución de Aprobación:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Anexos:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                                            </div>
                                        </div>                                       
                                        
                                    </section>
                                    <!-- Step 2 -->
                                    <h6><strong>Cronográma</strong></h6>
                                    <section>
                                        <div class="row form-group mb-0 py-2 bg-light">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Fecha Aprobación:<span class="text-danger"> *</span> </small>
                                                    <input type="date" class="form-control" id="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Fecha Publicación:<span class="text-danger"> *</span> </small>
                                                    <input type="date" class="form-control" id="">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row form-group border-bottom mb-0 py-3 bg-light">                                            
                                            <div class="col-md-6">
                                                    <div><small class="form-control-feedback font-weight-bold">Fecha y Hora de Inicio Inscripción:</small>
                                                        <input type="datetime-local" class="form-control" id="" value="2021-01-29T07:30:00"></div>                                                   
                                                    <!--<div class="col-md-5">Hora inicio:<input class="form-control" type="time" value="18:00:00"></div>-->                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div><small class="font-weight-bold">Fecha y Hora de Cerrar la Inscripción:</small> 
                                                    <input type="datetime-local" class="form-control" id="" value="2021-01-31T22:00:00"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="card-title">Contrato</h4>
                                        <h6 class="card-subtitle">Detalle el inicio y duración del contrato</h6>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <div> <input type="date" class="form-control" id="">    
                                                    <small class="font-weight-bold">Inicio del Contrato</small> </div>                                                                                                       
                                            </div>     
                                            <div class="col-md-6">
                                                <div class="form-group">                                                        
                                                    <input type="number" class="form-control" id="wfirstName2" name="firstName">
                                                    <small for="wfirstName2">Duración del contrato <span class="text-danger">(meses)</span> </small> </div>                                                
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6><strong>Configuraciones</strong></h6>
                                    <section>    
                                    <h4 class="card-title">Seleccione las etapas de evaluación:</h4>
                                                                     
                                    <!-- E. Curricular -->    
                                        <div class="row form-group mb-0 py-2 bg-light">
                                            <div class="col-md-3 " >
                                            </div>
                                            <div class="col-md-3 " >
                                                <h4 class="card-title">Puntaje Mínimo</h4>
                                            </div>
                                            <div class="col-md-3" >
                                                <h5 class="card-title">Puntaje Máximo</h5>
                                            </div>
                                            <div class="col-md-3" >
                                                <h4 class="card-title">Peso (%)</h4>
                                            </div>
                                        </div>                               
                                        <div class="row form-group mb-0 py-2 bg-light"> 
                                            <div class="form-group col-md-3 row justify-content-center align-items-center">
                                                <label class="custom-control custom-checkbox" >
                                                    <input type="checkbox" class="custom-control-input" checked>
                                                    <span class="custom-control-label"> <small>Curricular</small></span>                                                   
                                                </label>
                                            </div>                                                                                                                            
                                            <div class="col-md-3 border-left" >
                                                <div class="form-group">
                                                    <b><small for="wfirstName2">Evaluación Curricular:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="14">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Evaluación Curricular:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="20">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Evaluación Curricular:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="30">
                                                </div>
                                            </div>
                                        </div> 
                                    <!-- E. Conocimientos -->
                                        <div class="row form-group mb-0 py-1 bg-light"> 
                                            <div class="col-md-3 row justify-content-center align-items-center">
                                                <label class="custom-control custom-checkbox" >
                                                    <input type="checkbox" class="custom-control-input" >
                                                    <span class="custom-control-label"> <small>Conocimientos</small></span>                                                   
                                                </label>
                                            </div>                                                                                                                           
                                            <div class="col-md-3 border-left">
                                                    <b><small for="wfirstName2">Ev. Conocimientos:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="14">
                                                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Ev. Conocimientos:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="20">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Ev. Conocimientos:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="30">
                                                </div>
                                            </div>
                                        </div>
                                    <!-- E. Entrevista Personal -->
                                        <div class="row form-group border-bottom mb-0 bg-light">  
                                             <div class="col-md-3 row justify-content-center align-items-center">
                                                <label class="custom-control custom-checkbox" >
                                                    <input type="checkbox" class="custom-control-input" checked>
                                                    <span class="custom-control-label"> <small>Entrevista Personal</small></span>                                                   
                                                </label>
                                            </div>                                                                                                                           
                                            <div class="col-md-3 border-left">
                                                <div class="form-group">
                                                    <b><small for="wfirstName2">Ev. Entrevista Personal:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="14">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Ev. Entrevista Personal:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="20">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="wfirstName2">Ev. Entrevista Personal:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="40">
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Factores de evaluacion-->     
                                        <br>            
                                        <h4 class="card-title">Factores de Evaluación - Curricular: </h4>                   
                                        <div class="row form-group mb-0 py-2 bg-light">                                                                                                                            
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="wfirstName2">Años de Experiencia- General: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="2">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="wfirstName2">Años de Experiencia- Sector Público: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="1">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="wfirstName2">Horas de Capacitación- Total: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="500">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="wfirstName2">Horas de Capacitación- Individual: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required" id="wfirstName2" name="firstName" value="80">
                                            </div>
                                        </div>                                        
                                    <!-- Bonificaciones-->     
                                        <br>         
                                        <h4 class="card-title">Bonificaciones: </h4>                   
                                        <div class="row ">
                                            <div class="col-sm-9">
                                                <h5 class="control-label col-form-label">Bonificación por Discapacidad</h5>
                                            </div>
                                            <div class="col-sm-3">
                                                <fieldset>
                                                    <input name="bon_discapacidad" checked type="radio" id="1" class="radio-col-indigo material-inputs" />
                                                    <label for="1" class="mb-0 mt-2">Si</label>
                                                    <input name="bon_discapacidad" type="radio" id="2" class="radio-col-indigo material-inputs" />
                                                    <label for="2" class="mb-0 mt-2">No</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-sm-9">
                                                <h5 class="control-label col-form-label">Bonificación por ser Personal Licenciado de las Fuerzas Armadas</h5>
                                            </div>
                                            <div class="col-sm-3">
                                                <fieldset>
                                                    <input name="bon_ffaa"checked type="radio" id="3" class="radio-col-indigo material-inputs" />
                                                    <label for="3" class="mb-0 mt-2">Si</label>
                                                    <input name="bon_ffaa" type="radio" id="4" class="radio-col-indigo material-inputs" />
                                                    <label for="4" class="mb-0 mt-2">No</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-9">
                                                <h5 class="control-label col-form-label">Bonificación por Deportista Calificado</h5>
                                            </div>
                                            <div class="col-sm-3">
                                                <fieldset>
                                                    <input name="bon_deport" type="radio" id="5" class="radio-col-indigo material-inputs" />
                                                    <label for="5" class="mb-0 mt-2">Si</label>
                                                    <input name="bon_deport" checked type="radio" id="6" class="radio-col-indigo material-inputs" />
                                                    <label for="6" class="mb-0 mt-2">No</label>
                                                </fieldset>
                                            </div>
                                        </div>  
                                    <!--tabla editable -->
                                        <hr>
                                        <h4 class="card-title">Tabla Editable</h4>
                                        <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                                        <div class="table-responsive">
                                            <table id="mainTable"
                                                class="table editable-table table-bordered table-striped m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Cost</th>
                                                        <th>Profit</th>
                                                        <th>Fun</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Car</td>
                                                        <td>100</td>
                                                        <td>200</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bike</td>
                                                        <td>330</td>
                                                        <td>240</td>
                                                        <td>1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Plane</td>
                                                        <td>430</td>
                                                        <td>540</td>
                                                        <td>3</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Yacht</td>
                                                        <td>100</td>
                                                        <td>200</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Segway</td>
                                                        <td>330</td>
                                                        <td>240</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th><strong>TOTAL</strong></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    <!-- fin tabla editable-->                                
                                    </section>                                   
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Example -->
                    <!-- ============================================================== -->
               {{-- wizard FIN--}}
              
            </div>
            {{-- <div class="modal-footer">
               <button type="button" class="btn btn-light"
               data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}
               