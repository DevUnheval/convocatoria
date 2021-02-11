<!-- Full width modal content -->
<div id="modal_nueva_formacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header bg-success">
             <h4 class="modal-title text-white" id="fullWidthModalLabel">Datos Formación Academica</h4>
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
                              
                                  
                                    <div class="card-body wizard-content">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="tipo_estudio">Grado:<span class="danger">*</span> </label>
                                                  <select class="custom-select form-control" id="tipo_estudio" name="tipo_estudio" required>
                                                    <option value="">Seleccionar</option>
                                                    @foreach ($gradoformac as $gf)
                                                   <option value="{{$gf->id}}">{{$gf->nombre}}</option>
                                                   @endforeach
                                                   </select>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="especialidad">Especialidad:<span class="danger">*</span> </label>
                                                <input type="text" id="especialidad" class="form-control required"/> 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="centro_estudio_form">Centro de Estudio:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="centro_estudio_form" name="centro_estudio_form" > 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ciudad_form">Ciudad:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="ciudad_form" name="ciudad_form" required> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pais_form">Pais:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="pais_form" name="pais_form" > 
                                            </div>
                                        </div>
                                     </div>
                                      
                                      
                                      <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecha_exp">Fecha Expedición: <span class="danger">**</span> </label>
                                                <input type="date" class="form-control required" id="fecha_exp" name="fecha_exp" > 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecha_inicio">Fecha Inicio: <span class="danger">**</span> </label>
                                                <input type="date" class="form-control required" id="fecha_inicio" name="fecha_inicio" > 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecha_fin">Fecha Fin: <span class="danger">**</span> </label>
                                                <input type="date" class="form-control required" id="fecha_fin" name="fecha_fin" > 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="documento_formac">Documento de sustento: <span class="danger">*</span> </label>
                                                <input type="file" class="form-control required" id="documento_formac" name="documento_formac" > 
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="wemailAddress2"><small>(*) Indica un campo obligatorio</small> </label>
                                            <label for="wemailAddress2"><small>(**)En el campo "FECHA EXPEDICIÓN" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</small> </label>
                                            </div>  
                                       </div>
                                      </div>
                                      <br>
                                      <div  class="row">
                                        <div class="form-group col-md-12">
                                            <button id="btn_can_formac" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Cancelar
                                            </button>
                                            <button id="btn_guardar_formacion" class="btn btn-success waves-effect waves-light" >Guardar </button>  
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
            
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 