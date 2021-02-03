<!-- Full width modal content -->
<div id="modal_editar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header bg-warning" >
               <h4 class="modal-title"id="fullWidthModalLabel">Editar registro</h4>
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
                                <form action="#" class="tab-wizard wizard-circle" id="editar_convocatoria">
                                @csrf
                                    <!-- Step 1 -->
                                    <h6><strong>Datos generales</strong></h6>
                                    <section>
                                        <div class="row form-group mb-0 py-2 bg-light">                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <b><small>Código de la convocatoria:<span class="text-danger"> *</span> </small></b>
                                                    <input type="text" class="form-control required" name="cod"  id="cod">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small>Tipo de Proceso: <span class="text-danger"> *</span> </small>
                                                    <select class="custom-select form-control" name="tipo_id" id="tipo_id">
                                                        @foreach($datos['tipos_proc'] as $key => $tipo )
                                                        <option value="{{$key}}">{{$tipo}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small>Cantidad de plazas:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control required" name="n_plaza" id="n_plaza">
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="row form-group border-bottom mb-0 py-1 bg-light">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small>Nombre/Cargo de la convocatoria:<span class="text-danger"> *</span> </small>
                                                    <input type="text" class="form-control required"   name="nombre" id="nombre"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small>Area/Unidad al que postula:<span class="text-danger"> *</span> </small>
                                                    <input type="text" class="form-control required"   name="oficina" id="oficina">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small>Descripción (opcional)</small>
                                                    <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Escribir aquí..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Bases:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file" name="archivo_bases">  
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 text-left control-label col-form-label">Resolución de Aprobación:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control-file" name="archivo_resolucion">
                                            </div>
                                        </div>                                    
                                        
                                    </section>
                                    <!-- Step 2 -->
                                    <h6><strong>Cronográma</strong></h6>
                                    <section>
                                        <div class="row form-group mb-0 py-2 bg-light">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small>Fecha Aprobación:<span class="text-danger"> *</span> </small>
                                                    <input type="date" class="form-control" name="fecha_aprobacion"  id="fecha_aprobacion">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small>Fecha Publicación:<span class="text-danger"> *</span> </small>
                                                    <input type="date" class="form-control required" name="fecha_publicacion" id="fecha_publicacion">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row form-group border-bottom mb-0 py-3 bg-light">                                            
                                            <div class="col-md-6">
                                                    <div><small class="font-weight-bold">Inicio Inscripción:<span class="text-danger"> *</span></small>
                                                        <input type="datetime-local" class="form-control required" name="fecha_inscripcion_inicio" id="fecha_inscripcion_inicio"></div>                                                   
                                                    <!--<div class="col-md-5">Hora inicio:<input class="form-control" type="time" value="18:00:00"></div>-->                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div><small class="font-weight-bold">Cierre la Inscripción:<span class="text-danger"> *</span></small> 
                                                    <input type="datetime-local" class="form-control required" name="fecha_inscripcion_fin"  id="fecha_inscripcion_fin"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="card-title">Contrato</h4>
                                        <h6 class="card-subtitle">Detalle el inicio y duración del contrato (opcional)</h6>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <div> <input type="date" class="form-control" name="fecha_firma_contrato" id="fecha_firma_contrato">    
                                                    <small class="font-weight-bold">Inicio del Contrato</small> </div>                                                                                                       
                                            </div>     
                                            <div class="col-md-6">
                                                <div class="form-group">                                                        
                                                    <input type="text" class="form-control" name="duracion_contrato" id="duracion_contrato">
                                                    <small>Duración del contrato <span class="text-danger">(campo de texto)</span> </small> </div>                                                
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
                                                    <b><small>Evaluación Curricular:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control fila_curricular required" name="pje_min_cv" id="pje_min_cv">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small>Evaluación Curricular:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_curricular required" name="pje_max_cv" id="pje_max_cv">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small>Evaluación Curricular:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_curricular required" name="peso_cv" id="peso_cv">
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
                                                    <b><small>Ev. Conocimientos:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control  fila_conocimiento"   name="pje_min_conoc" id="pje_min_conoc" disabled>
                                                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small>Ev. Conocimientos:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control  fila_conocimiento"   name="pje_max_conoc" id="pje_max_conoc" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small>Ev. Conocimientos:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control  fila_conocimiento"   name="peso_conoc" id="peso_conoc" disabled>
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
                                                    <b><small>Ev. Entrevista Personal:<span class="text-danger"> *</span> </small></b>
                                                    <input type="number" class="form-control fila_entrevista required"   name="pje_min_entrev" id="pje_min_entrev">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small>Ev. Entrevista Personal:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_entrevista required"   name="pje_max_entrev" id="pje_max_entrev">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <small>Ev. Entrevista Personal:<span class="text-danger"> *</span> </small>
                                                    <input type="number" class="form-control fila_entrevista required"   name="peso_entrev" id="peso_entrev">
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Factores de evaluacion-->     
                                        <br>            
                                        <h4 class="card-title">Factores de Evaluación - Curricular: </h4>                   
                                        <div class="row form-group mb-0 py-2 bg-light">                                                                                                                            
                                            <div class="col-md-6 form-group">                                                
                                                <b><small>Años de Experiencia - General: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required"   name="anios_exp_lab_gen" id="anios_exp_lab_gen">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small>Años de Experiencia - Especifica: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required"   name="anios_exp_lab_esp" id="anios_exp_lab_esp">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small>Horas de Capacitación- Total: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required"   name="horas_cap_total" id="horas_cap_total">
                                            </div>
                                            <div class="col-md-6 form-group">                                                
                                                <b><small>Horas de Capacitación- Individual: <span class="text-danger">(mínimo)</span> </small></b>
                                                <input type="number" class="form-control required" name="horas_cap_ind" id="horas_cap_ind">
                                            </div>
                                        </div>                                        
                                    <!-- Bonificaciones-->     
                                        <br>         
                                        <h4 class="card-title">Bonificaciones: </h4>                   
                                        <div class="row ">
                                            <div class="col-sm-9">
                                                <h5 class="control-label col-form-label">Bonificación por Discapacidad <small>(15%)</small></h5>
                                                <label><small>Ley N° 29973, Ley General de la Persona con Discapacidad.</small></label>
                                            </div>
                                            <div class="col-sm-3">
                                                <fieldset>
                                                    <input name="hay_bon_pers_disc" value=1  checked type="radio" id="hay_bon_pers_disc_1" class="radio-col-indigo material-inputs" />
                                                    <label for="hay_bon_pers_disc_1" class="mb-0 mt-2">Si</label>
                                                    <input name="hay_bon_pers_disc" value=0  type="radio" id="hay_bon_pers_disc_2" class="radio-col-indigo material-inputs" />
                                                    <label for="hay_bon_pers_disc_2" class="mb-0 mt-2">No</label>
                                                </fieldset>
                                            </div>
                                        </div><hr>
                                        <div class="row ">
                                            <div class="col-sm-9">
                                                <h6 class="control-label col-form-label">Bonificación por ser Personal Licenciado de las Fuerzas Armadas<small>(10%)</small></h6>
                                                <label><small>Ley N° 29248, Ley del Servicio Militar.</small></label>
                                            </div>
                                            <div class="col-sm-3">
                                                <fieldset>
                                                    <input name="hay_bon_ffaa" value=1  checked type="radio" id="hay_bon_ffaa_1" class="radio-col-indigo material-inputs" />
                                                    <label for="hay_bon_ffaa_1" class="mb-0 mt-2">Si</label>
                                                    <input name="hay_bon_ffaa" value=0  type="radio" id="hay_bon_ffaa_2" class="radio-col-indigo material-inputs" />
                                                    <label for="hay_bon_ffaa_2" class="mb-0 mt-2">No</label>
                                                </fieldset>
                                            </div>
                                        </div><hr>
                                        <div class="row form-group">
                                            <div class="col-sm-9">
                                                <h5 class="control-label col-form-label">Bonificación por Deportista Calificado</h5>
                                                <label><small>Se otorgará una bonificación de acuerdo al Decreto Supremo N° 089-2003-PCM,
                                                 que aprueba el Reglamento de la Ley N° 27674, Ley que establece el acceso de Deportistas de Alto Nivel a la Administración Pública.</small></label>
                                            </div>
                                            <div class="col-sm-3">
                                                <fieldset>
                                                    <input name="hay_bon_deport" type="radio" value=1 id="hay_bon_deport_1" class="radio-col-indigo material-inputs" />
                                                    <label for="hay_bon_deport_1" class="mb-0 mt-2">Si</label>
                                                    <input name="hay_bon_deport" checked type="radio" value=0 id="hay_bon_deport_2" class="radio-col-indigo material-inputs" />
                                                    <label for="hay_bon_deport_2" class="mb-0 mt-2">No</label>
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
               