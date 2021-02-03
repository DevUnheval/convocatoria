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
                              <form action="#" class="tab-wizard wizard-circle" id="nueva_convocatoria">
                                 
                                  <h6><strong>Datos del Usuario</strong></h6>
                                  <section>
                                      <div class="row form-group mb-0 py-2 bg-light">                                            
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <b><small for="wfirstName2">DNI:<span class="text-danger"> *</span> </small></b>
                                                  <input type="text" class="form-control required" id="wfirstName2" name="firstName">
                                              </div>
                                          </div>
                                          {{-- <div class="col-md-4">
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
                                          </div> --}}
                                          {{-- <div class="col-md-4">
                                              <div class="form-group">
                                                  <small for="wfirstName2">Cantidad de plazas:<span class="text-danger"> *</span> </small>
                                                  <input type="number" class="form-control required" id="wfirstName2" name="firstName">
                                              </div>
                                          </div> --}}
                                      </div>                                        
                                      <div class="row form-group border-bottom mb-0 py-1 bg-light">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <small for="wemailAddress2">Nombres:<span class="text-danger"> *</span> </small>
                                                  <input type="text" class="form-control required" id="wemailAddress2" name="emailAddress" placeholder=""> 
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <small for="wemailAddress2">Apellido Paterno:<span class="text-danger"> *</span> </small>
                                                <input type="text" class="form-control required" id="wemailAddress2" name="emailAddress" placeholder=""> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small for="wemailAddress2">Apellido Materno:<span class="text-danger"> *</span> </small>
                                                <input type="text" class="form-control required" id="wemailAddress2" name="emailAddress" placeholder=""> 
                                            </div>
                                        </div>
                                    </div>                                                                           
                                <div class="card-body">
                                    <h4 class="card-title">Subir foto</h4>
                                    <form class="mt-3">
                                        <fieldset class="form-group">
                                            <input type="file" class="form-control-file" id="exampleInputFile">
                                        </fieldset>
                                    </form>
                                 </div>
                                   
                                 <h4 class="card-title mt-4">Roles</h4>
                                 <div class="row">
                                    @foreach($roles as $key => $rol)
                                    <div class="col-md-3">
                                        <input type="checkbox" id="md_checkbox_{{$key}}" class="material-inputs chk-col-amber"/>
                                        <label for="md_checkbox_{{$key}}">{{$rol}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                      
                                      
            
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
             