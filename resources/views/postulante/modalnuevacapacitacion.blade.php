<!-- Full width modal content -->
<div id="modal_nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header bg-success">
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
                              <form>
                                  
                                    <div class="card-body wizard-content">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="tipo_estudio">Tipo de estudio:<span class="danger">*</span> </label>
                                                  <select class="custom-select form-control" id="tipo_estudio" name="tipo_estudio">
                                                    <option value="">*Seleccione*</option>
                                                    <option value="Curso">Curso</option>
                                                    <option value="Programa Especializacion">Programa de Especialización</option>
                                                  </select>
                                              </div>
                                          </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="descripcion" name="descripcion" > 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="institucion">Institución:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="institucion" name="institucion" > 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pais">Pais: <span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="pais" name="pais" > 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad :<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="ciudad" name="ciudad" >
                                            </div>
                                        </div>
                                      </div>   
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="fechainicio">Fecha de inicio: <span class="danger">*</span> </label>
                                                  <input type="date" class="form-control required" id="fechainicio" name="fechainicio" > 
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="fechafin">Fecha de fin :<span class="danger">*</span> </label>
                                                  <input type="date" class="form-control required" id="fechafin" name="fechafin">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="horaslectivas">Horas lectivas: <span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="horaslectivas" name="horaslectivas" > 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="documento">Documento de sustento: <span class="danger">*</span> </label>
                                                <input type="file" class="form-control required" id="documento" name="documento" > 
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
 