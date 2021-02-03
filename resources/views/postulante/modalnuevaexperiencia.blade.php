<!-- Full width modal content -->
<div id="modal_nueva_experiencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header bg-success">
             <h4 class="modal-title text-white" id="fullWidthModalLabel">Datos Experiencia Laboral</h4>
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
                              <form>
                                  
                                    <div class="card-body wizard-content">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="tipo_experiencia">Tipo de Experiencia:<span class="danger">*</span> </label>
                                                  <select class="custom-select form-control" id="tipo_experiencia" name="tipo_experiencia">
                                                    <option value="">*Seleccionar*</option>
                                                    <option value="">Laboral</option>
                                                    <option value="">Prácticas Pre Profesionales</option>
                                                    <option value="">Prácticas Profesionales</option>
                                                    
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipo_entidad">Tipo Entidad:<span class="danger">*</span> </label>
                                                <select class="custom-select form-control" id="tipo_entidad" name="tipo_entidad">
                                                  <option value="">*Seleccionar*</option>
                                                  <option value="">Público</option>
                                                  <option value="">Privado</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre_entidad">Nombre de Entidad:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="nombre_entidad" name="nombre_entidad" > 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="area">Área:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="area" name="area" > 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cargo">Cargo:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="cargo" name="cargo" > 
                                            </div>
                                        </div>
                                     </div>
                                      
                                      
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fecha">Funciones principales: <span class="danger">*</span> </label>
                                                <input type="textarea" class="form-control required" id="fecha" name="fecha" > 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_inicio">Fecha Inicio: <span class="danger">*</span> </label>
                                                <input type="date" class="form-control required" id="fecha_inicio" name="fecha_inicio" > 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_fin">Fecha fin: <span class="danger">*</span> </label>
                                                <input type="date" class="form-control required" id="fecha_fin" name="fecha_fin" > 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="documento">Documento sustento: <span class="danger">*</span> </label>
                                                <input type="file" class="form-control required" id="documento" name="documento" > 
                                            </div>
                                        </div>
                                        
                                      </div>
                                      
                                      <br>
                                      <div  class="row">
                                        <div class="form-group col-md-12">
                                            <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Cancelar
                                            </button>
                                            <button class="btn btn-success waves-effect waves-light" type="submit">Guardar
                                            </button>  
                                        </div>
                                    </div>
                                  </div>
                                      
                                    
                                    
                                </form>
                          </div>
                      </div>
                  </div>
                  <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
             {{-- wizard FIN--}}
            
            </div>
            
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 