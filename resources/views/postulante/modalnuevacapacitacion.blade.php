<!-- Full width modal content -->
<div id="modal_nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div id="header-capacitacion" class="modal-header bg-success">
             <h4 class="modal-title text-white" id="fullWidthModalLabel">Nuevo Curso y/o Programa de Especialización</h4>
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
                              <form class="needs-validation2" novalidate> 
                                  
                                    <div class="card-body wizard-content">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="tipo_capacitacion">Tipo de estudio:<span class="danger">*</span> </label>
                                                  <select class="custom-select form-control" id="tipo_capacitacion" name="tipo_capacitacion" required>
                                                    <option value="">*Seleccione*</option>
                                                    <option value="1">Curso/Especialización</option>
                                                    <option value="2">Offimática</option>
                                                    <option value="3">Idioma</option>
                                                  </select>
                                              </div>
                                          </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" required> 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institucion">Institución:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control" id="institucion" name="institucion" required> 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pais_capacit">Pais: <span class="danger">*</span> </label>
                                                <input type="text" class="form-control " id="pais_capacit" name="pais_capacit" required> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ciudad_capacit">Ciudad :<span class="danger">*</span> </label>
                                                <input type="text" class="form-control " id="ciudad_capacit" name="ciudad_capacit" required>
                                            </div>
                                        </div>
                                      </div>   
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="fechainicio_capac">Fecha de inicio: <span class="danger">*</span> </label>
                                                  <input type="date" class="form-control " id="fechainicio_capac" name="fechainicio_capac"  required> 
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="fechafin_capac">Fecha de fin :<span class="danger">*</span> </label>
                                                  <input type="date" class="form-control " id="fechafin_capac" name="fechafin_capac" required>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="horaslectivas">Horas lectivas: <span class="danger">*</span> </label>
                                                <input type="text" class="form-control " id="horaslectivas" name="horaslectivas" required > 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nivel_capa">Nivel: <span class="danger">*</span> </label>
                                                <input type="text" class="form-control " id="nivel_capa" name="nivel_capa" required> 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="documento_capa">Documento de sustento: <span class="danger">*</span> </label>
                                                <input type="file" class="form-control" id="documento_capa" name="documento_capa" required> 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="wemailAddress2">(*) Indica un campo obligatorio </label>
                                            </div>  
                                       </div>
                                      </div>
                                      <br>
                                      <div  class="row">
                                        <div class="form-group col-md-12">
                                            <button id="btn_can_capacitacion" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Cancelar
                                            </button>
                                            <span id="div_btn_capacitacion"></span> 
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
 