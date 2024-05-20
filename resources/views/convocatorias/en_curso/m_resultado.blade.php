<!-- Full width modal content -->
<div id="modal_resultado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
       <div class="modal-content">
          <div class="modal-header bg-info" >
             <h4 class="modal-title text-white"id="fullWidthModalLabel">Resultado</h4>
             <button type="button" class="close btn-light" data-dismiss="modal"
             aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
               <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
                    <div class="card-body row"> 
                            <input type="hidden" id="id_proceso_r">
                            <fieldset>
                                <input name="tipo" id="archivo_tipo_local" value="local" type="radio" class="radio-col-indigo material-inputs resultado-check" checked />
                                <label for="archivo_tipo_local" class="mb-0 mt-2">Local</label>

                                <input name="tipo" id="archivo_tipo_web" value="web"  type="radio"  class="radio-col-indigo material-inputs resultado-check" />
                                <label for="archivo_tipo_web" class="mb-0 mt-2">Link</label>
                            </fieldset>
                            <br><br>
                            <div class="col-sm-12" >
                                <small class="font-weight-bold">Fecha de Publicación:<span class="text-danger"> *</span></small>
                                <input type="datetime-local" class="form-control required" name="fecha_publicacion_resultado" id="fecha_publicacion_resultado" aria-invalid="false" required> 
                            </div> 
                            <br><br><br><br>
                            <div class="col-sm-12" id="div_resultado_file">                                                  
                                <input type="file" class="form-control-file archivo_tipo" id="archivo_resultado" name="archivo_resultado">
                            </div>                                              
                    </div>    
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-success" id="btn_guardar_resultado">Guardar resultado</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
          </div>
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
 {{-- Modal End --}}