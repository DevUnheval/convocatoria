<!-- Full width modal content -->
<div id="modal_evaluacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header bg-danger" >
             <h4 class="modal-title text-white"id="fullWidthModalLabel">Evaluacion</h4>
             <button type="button" class="close btn-light" data-dismiss="modal"
             aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
               <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
                  <div class="col-12">
                      <div class="card">
                          <!-- Inicio de los Tabs -->
                          <div class="card-body">
                              <!--<h4 class="card-title mb-3">CAS - 011-2021</h4>-->
                              
                              @if(auth()->check() && auth()->user()->hasRoles(['Administrador','Comisionado']))
                              <form id="form_evaluacion">
                                  <div class="row form-group mb-0 py-2 bg-light">                                            
                                      <div class="col-md-5">
                                          <div class="form-group">
                                              <b><small>Nombre:</small></b>
                                              <input type="text" class="form-control required" id="nombre_nuevo_evaluacion" name="nombre">
                                              <input type="hidden"   name="proceso_id" id="proceso_id_evaluacion">
                                          </div>
                                      </div>
                                      <div class="col-md-5">
                                          <div class="form-group">
                                              <b><small>Evaluacion:</small></b>
                                              <input type="file" class="form-control required" id="file_evaluacion"  name="archivo">
                                          </div>
                                      </div>
                                      <div class="col-md-2">
                                          <div class="form-group"><br>
                                              <button type="button" class="btn btn-outline-success btn-rounded btn-sm" onclick="guardar_evaluacion()"><i class="fa fa-save"></i> Guardar</button>
                                          </div>
                                      </div>
                                     
                                  </div>
                              </form><hr>
                              @endif
                              <div class="table-responsive ">
                                  <table class="table table-hover table-bordered col-md-12" id="tabla_evaluacion_procesos">
                                      <thead class="">
                                      <tr>
                                          <th>Fecha</th>
                                          <th>Nombre</th>
                                          <th>Comunicado</th>
                                          @if(auth()->check() && auth()->user()->hasRoles(['Administrador','Comisionado']))
                                          <th>Acciones</th>
                                          @endif
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table>
                              </div>  
                          </div>
                          
                      </div>
                  </div>              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
 {{-- Modal End --}}
             