<!-- Full width modal content -->
<div id="modal_nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title" id="fullWidthModalLabel">Nuevo Curso y/o Capacitación</h4>
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
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="wfirstName2">Código de la convocatoria:<span class="danger">*</span> </label>
                                                  <input type="text" class="form-control required" id="wfirstName2" name="firstName">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="wlastName2">Tipo de Proceso: <span class="danger">*</span> </label>
                                                  <select class="custom-select form-control" id="location1" name="location">
                                                      <option value="">*Seleccione*</option>
                                                      <option value="Amsterdam">CAS/1057</option>
                                                      <option value="Frankfurt">Prácticas</option>
                                                      <option value="Berlin">276</option>
                                                      <option value="Frankfurt">728</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="wfirstName2">Cantidad de plazas:<span class="danger">*</span> </label>
                                                  <input type="number" class="form-control required" id="wfirstName2" name="firstName">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="wemailAddress2">Nombre de la convocatoria: <span class="danger">*</span> </label>
                                                  <input type="text" class="form-control required" id="wemailAddress2" name="emailAddress" placeholder="Cargo al que postula"> 
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="wphoneNumber2">Puesto de la convocatoria :<span class="danger">*</span> </label>
                                                  <input type="text" class="form-control required" id="wphoneNumber2" placeholder="Area/Unidad al que postula">
                                              </div>
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
            <div class="modal-footer">
                
                <button type="button" class="btn btn-info">Guardar</button>
            </div>
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 