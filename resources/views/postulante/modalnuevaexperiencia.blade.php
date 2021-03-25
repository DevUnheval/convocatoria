<!-- Full width modal content -->
<div id="modal_nueva_experiencia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div id="header-experiencia" class="modal-header bg-success">
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
                              <form class="needs-validation3" novalidate>
                                @csrf  
                                    <div class="card-body wizard-content">
                                        <div class="form-row border-ligth border bg-ligth-warning  alert alert-secondary">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exp_general" class="align-top">Experiencia General:<span class="text"> *</span> </label>
                                                    <input style="width: 20px; height: 20px" id="exp_general" class="align-middle" name="exp_general" checked value="1" type="checkbox" disabled />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                              <div class="form-group">
                                                  <label for="exp_especifica" class="align-middle">Experiencia Específica:<span class="text-danger"> *</span> </label>
                                                  <input style="width: 20px; height: 20px" id="exp_especifica" class="align-middle" name="exp_especifica" value="1" type="checkbox" />
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="tipo_experiencia">Tipo de Experiencia:<span class="text-danger"> *</span> </label>
                                                  <select class="custom-select form-control" id="tipo_experiencia" name="tipo_experiencia" required>
                                                    <option value="">*Seleccionar*</option>
                                                    <option value=1>Experiencia Laboral</option>
                                                    <option value=2>Prácticas Pre Profesionales</option>
                                                    <option value=3>Prácticas Profesionales</option>
                                                    
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipo_entidad">Tipo Entidad:<span class="text-danger"> *</span> </label>
                                                <select class="custom-select form-control" id="tipo_entidad" name="tipo_entidad" required>
                                                  <option value="">*Seleccionar*</option>
                                                  <option value="1">Público</option>
                                                  <option value="2">Privado</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre_entidad">Nombre de Entidad:<span class="text-danger"> *</span> </label>
                                                <input type="text" class="form-control required" id="nombre_entidad" name="nombre_entidad" required> 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cargo_exp">Cargo:<span class="text-danger"> *</span> </label>
                                                <input type="text" class="form-control required" id="cargo_exp" name="cargo_exp" required> 
                                            </div>
                                        </div>
                                     </div>
                                      
                                      
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="funciones_princi">Funciones principales: <span class="text-danger"> *</span> </label>
                                                <textarea type="textarea" class="form-control required" id="funciones_princi" name="funciones_princi" required></textarea> 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_inicio_exp">Fecha Inicio: <span class="text-danger"> *</span> </label>
                                                <input type="date" class="form-control required" id="fecha_inicio_exp" name="fecha_inicio_exp" min="1950-01-01" max="{{date('Y-m-d')}}" required> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_fin_exp">Fecha fin: <span class="text-danger"> *</span> </label>
                                                <input type="date" class="form-control required" id="fecha_fin_exp" name="fecha_fin_exp" min="1950-01-01" max="{{date('Y-m-d')}}" required> 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="documento_exp">Documento sustento: <small>(solo archivos .pdf - Tamaño máximo de archivo 5MB)</small> <span class="text-danger"> *</span> </label>
                                                <input type="file" class="form-control required" id="documento_exp"  name="documento_exp" accept="application/pdf" required> 
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="num_pag">N° página donde señala inicio y fin de la experiencia: <span class="text-danger">*</span> </label>
                                                <input type="number" class="form-control" id="num_pag" name="num_pag" required> 
                                            </div>
                                        </div>
                                      </div>                                      
                                      <hr>
                                      <div  class="row">
                                        <div class="form-group col-md-12" >
                                            <button id="btn_cancelar_exper" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Cancelar
                                            </button>
                                            <span id="div_btns_exper"></span>  
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
 