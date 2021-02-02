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
                                @csrf
                                    <!-- Step 1 -->
                                    <h6><strong>Datos generales</strong></h6>
                                    <section>
                                        <div class="row form-group mb-0 py-2 bg-light">                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <b><small for="cod_conv">Código de la convocatoria:<span class="text-danger"> *</span> </small></b>
                                                    <input type="text" class="form-control required"   name="cod_conv" value="001-2021">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small for="t_proceso">Tipo de Proceso: <span class="text-danger"> *</span> </small>
                                                    <select class="custom-select form-control" name="t_proceso">
                                                        <option value="cas">CAS/1057</option>
                                                        <option value="practicas">Prácticas</option>
                                                        <option value="276">276</option>
                                                        <option value="728">728</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small for="cant_plaza">Cantidad de plazas:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" name="cant_plaza"value="1">
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="row form-group border-bottom mb-0 py-1 bg-light">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="n_conv">Nombre/Cargo de la convocatoria:<span class="text-danger"> *</span> </small>
                                                    <input type="text" class="form-control required"   name="n_conv" value="Especialista Administrativo" placeholder=""> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="n_area">Area/Unidad al que postula:<span class="text-danger"> *</span> </small>
                                                    <input type="text" class="form-control required"   name="n_area" value="Unidad de Recursos Humanos" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Bases:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file"  >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Resolución de Aprobación:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file"   aria-describedby="fileHelp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Anexos:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file"   aria-describedby="fileHelp">
                                            </div>
                                        </div>                                       
                                        
                                    </section>
                                    <!-- Step 2 -->
                                    <h6><strong>Cronográma</strong></h6>
                                    <section>
                                        <div class="row form-group mb-0 py-2 bg-light">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="f_aprobacion">Fecha Aprobación:<span class="text-danger"> *</span> </small>
                                                    <input type="date" class="form-control" name="f_aprobacion">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small for="f_publicacion">Fecha Publicación:<span class="text-danger"> *</span> </small>
                                                    <input type="date" class="form-control required" name="f_publicacion"  value="2021-01-26">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row form-group border-bottom mb-0 py-3 bg-light">                                            
                                            <div class="col-md-6">
                                                    <div><small class="font-weight-bold" for="f_inicio">Fecha y Hora de Inicio Inscripción:<span class="text-danger"> *</span></small>
                                                        <input type="datetime-local" class="form-control required" name="f_inicio" value="2021-01-29T07:30:00"></div>                                                   
                                                    <!--<div class="col-md-5">Hora inicio:<input class="form-control" type="time" value="18:00:00"></div>-->                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div><small class="font-weight-bold" for="f_fin">Fecha y Hora de Cerrar la Inscripción:<span class="text-danger"> *</span></small> 
                                                    <input type="datetime-local" class="form-control required" name="f_fin"   value="2021-01-31T22:00:00"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="card-title">Contrato</h4>
                                        <h6 class="card-subtitle">Detalle el inicio y duración del contrato (opcional)</h6>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <div> <input type="date" class="form-control"  >    
                                                    <small class="font-weight-bold">Inicio del Contrato</small> </div>                                                                                                       
                                            </div>     
                                            <div class="col-md-6">
                                                <div class="form-group">                                                        
                                                    <input type="number" class="form-control" name="d_contrato">
                                                    <small for="d_contrato">Duración del contrato <span class="text-danger">(meses)</span> </small> </div>                                                
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6><strong>Configuraciones</strong></h6>
                                    <section>    
                                    <h4 class="card-title">Seleccione las etapas de evaluación:</h4>
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
                                    <!-- E. Curricular -->                            
                                        <div class="row form-group mb-0 py-2 bg-light"> 
                                            <div class="form-group col-md-3 row justify-content-center align-items-center">
                                                <label><small>Curricular</small></label>
                                            </div>                                                                                                                            
                                            <div class="col-md-3 border-left" >
                                                <div class="form-group">
                                                    <b><small for="f_curricular">Evaluación Curricular:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control fila_curricular required"   name="f_curricular" value="14">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="f_curricular2">Evaluación Curricular:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_curricular required"   name="f_curricular2" value="20">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="f_curricular3">Evaluación Curricular:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_curricular required"   name="f_curricular3" value="30">
                                                </div>
                                            </div>
                                        </div> 
                                    <!-- E. Conocimientos -->
                                        <div class="row form-group mb-0 py-1 bg-light"> 
                                            <div class="col-md-3 row justify-content-center align-items-center">
                                                <label class="custom-control custom-checkbox" >
                                                    <input type="checkbox" class="custom-control-input" id="check_conocimientos" >
                                                    <span class="custom-control-label"> <small>Conocimientos</small></span>                                                   
                                                </label>
                                            </div>                                                                                                                           
                                            <div class="col-md-3 border-left">
                                                    <b><small for="f_cono1">Ev. Conocimientos:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control  fila_conocimiento"   name="f_cono1" disabled>
                                                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="f_cono2">Ev. Conocimientos:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control  fila_conocimiento"   name="f_cono2" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="f_cono3">Ev. Conocimientos:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control  fila_conocimiento"   name="f_cono3" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- E. Entrevista Personal -->
                                        <div class="row form-group border-bottom mb-0 bg-light">  
                                             <div class="col-md-3 row justify-content-center align-items-center">
                                                <label><small>Entrevista Personal</small></label>
                                            </div>                                                                                                                           
                                            <div class="col-md-3 border-left">
                                                <div class="form-group">
                                                    <b><small for="f_entrevista1">Ev. Entrevista Personal:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control fila_entrevista required"   name="f_entrevista1" value="14">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="f_entrevista2">Ev. Entrevista Personal:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_entrevista required"   name="f_entrevista2" value="20">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small for="f_entrevista3">Ev. Entrevista Personal:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_entrevista required"   name="f_entrevista3" value="40">
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Factores de evaluacion-->     
                                        <br>            
                                        <h4 class="card-title">Factores de Evaluación - Curricular: </h4>                   
                                        <div class="row form-group mb-0 py-2 bg-light">                                                                                                                            
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="exp_general">Años de Experiencia- General: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required"   name="exp_general" value="2">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="exp_esp">Años de Experiencia- Sector Público: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required"   name="exp_esp" value="1">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="h_cap_total">Horas de Capacitación- Total: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required"   name="h_cap_total" value="500">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small for="h_cap_ind">Horas de Capacitación- Individual: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required" name="h_cap_ind" value="80">
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
                                                    <input name="bon_deport" type="radio" value=true id="5" class="radio-col-indigo material-inputs" />
                                                    <label for="5" class="mb-0 mt-2">Si</label>
                                                    <input name="bon_deport" checked type="radio" value=false id="6" class="radio-col-indigo material-inputs" />
                                                    <label for="6" class="mb-0 mt-2">No</label>
                                                </fieldset>
                                            </div>
                                        </div>                                 
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
               