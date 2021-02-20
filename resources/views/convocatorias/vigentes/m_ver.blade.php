<!-- Full width modal content -->
<div id="modal_ver_mas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header bg-warning" >
               <h4 class="modal-title text-white" id="fullWidthModalLabel">Detalles de la Convocatoria</h4>
               <button type="button" class="close btn-light" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
             {{-- wizard --}}
                 <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
                  <div class="col-12">
                     <div class="card">
                        <!-- Inicio de los Tabs -->
                        <div class="card-body">
                           <!--modelo 1 --borde --> 
                           <div class="row">
                              <div class="col-md-12 card border-ligth border bg-ligth-warning  alert alert-secondary">
                                 <div class="row ">
                                    <div class="col-md-3 ">
                                       <div class="form-group">
                                             <b><small class="text-info">Cód. convocatoria:</small></b><br>
                                             <h5 id="ver_cod"></h5>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                             <b><small class="text-info">Tipo Proceso:</small></b><br>
                                                @foreach($datos['tipos_proc'] as $key => $tipo )
                                                <h5 id="ver_tipo_id_{{$key}}" class="ocultar_elemento" hidden> {{$tipo }}</h5>
                                                @endforeach
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                             <b><small class="text-info">Nº plazas:</small></b><br>
                                             <h5 id="ver_n_plazas"></h5>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                             <b><small class="text-info">Remuneración:</small></b><br>
                                             <h5 id="ver_remuneracion"></h5>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>    
                           <!--modelo 2 
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-3 ">
                                       <div class="form-group">
                                             <b><small class="text-info">Cód. convocatoria:</small></b><br>
                                             <h5 id="ver_cod"></h5>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                             <b><small class="text-info">Tipo Proceso:</small></b><br>
                                                @foreach($datos['tipos_proc'] as $key => $tipo )
                                                <h5 id="ver_tipo_id_{{$key}}" class="ocultar_elemento" hidden> {{$tipo }}</h5>
                                                @endforeach
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                             <b><small class="text-info">Nº plazas:</small></b><br>
                                             <h5 id="ver_n_plazas"></h5>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                             <b><small class="text-info">Remuneración:</small></b><br>
                                             <h5 id="ver_remuneracion"></h5>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                            fin modelo 2 
                           <hr>-->
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                       <small class="text-info">Nombre/Cargo de la convocatoria: </small>
                                       <h5 id="ver_nombre"></h5>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                       <small class="text-info">Área/Oficina: </small>
                                       <h5 id="ver_oficina"></h5>
                                 </div>
                              </div>
                           </div>  
                           <hr> 
                           <div class="row"> 
                              <div class="col-md-4">
                                 <div class="form-group">
                                       <small class="text-info">Formación académica:  </small>
                                       @foreach($datos['grado_formacion'] as $key => $nivel )
                                       <h5 id="ver_nivel_acad_convocar_{{$key}}" class="ocultar_elemento" hidden>{{$nivel}}</h5>
                                       @endforeach
                                       <h5 id="ver_especialidad"></h5>
                                 </div>
                              </div>  
                              <div class="col-md-4">
                                 <div class="form-group">
                                       <small class="text-info">Experiencia laboral general </small>
                                       <h5 id="ver_exp_lab_gen"></h5>
                                 </div>
                              </div>  
                              <div class="col-md-4">
                                 <div class="form-group">
                                       <small class="text-info">Experiencia laboral específica </small>
                                       <h5 id="ver_exp_lab_esp"></h5>
                                 </div>
                              </div>
                           </div>
                           <hr>
                           <div class="row">  
                              <div class="col-md-4 ocultar_elemento" id="div_ver_capacitaciones">
                                 <div class="form-group">
                                       <small class="text-info">Capacitaciones </small>
                                       <h5 id="ver_capacitaciones"></h5>
                                 </div>
                              </div>
                              <div class="col-md-4 ocultar_elemento" id="div_ver_habilidades">
                                 <div class="form-group">
                                       <small class="text-info">Habilidades </small>
                                       <h5 id="ver_habilidades"></h5>
                                 </div>
                              </div>
                              <div class="col-md-4 ocultar_elemento" id="div_ver_descripcion">
                                 <div class="form-group">
                                       <small class="text-info">Otros datos: </small>
                                       <h5 id="ver_descripcion"></h5>
                                 </div>
                              </div>
                           </div>
                           <hr>                           
                           <div class="row">    
                              <div class="col-md-5">
                                 <div class="form-group">
                                       <small class="text-info">Plazo para Postular</small>
                                       <h5 id="ver_postulacion"></h5>
                                 </div>
                              </div>  
                              <div class="col-md-3 border-left">
                                 <div class="form-group">
                                       <small class="text-info">Duración del Contrato</small>
                                       <h5 id="ver_duracion_contrato"></h5>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                       <small class="text-info">Inicio de contrato</small>
                                       <h5 id="ver_fecha_firma_contrato"></h5>
                                 </div>
                              </div> 
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                       <small class="text-info">Bases: </small><br>
                                       <a href="#" id="ver_bases" target="_blank" class="btn btn-danger"> 
                                       <i class="fa fa-download"></i> Descargar Bases</a>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                       <small class="text-info">Resolución: </small><br>
                                       <a href="#" id="ver_resolucion" target="_blank" class="btn btn-danger">
                                             <i class="fa fa-download"></i> Descargar Resolución</a>
                                 </div>
                              </div>
                           </div>
                        </div>                      
                     </div>
                  </div>
                  <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
               {{-- wizard FIN--}}
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}
               