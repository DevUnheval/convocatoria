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
                              <form>
                                  
                                    <div class="card-body wizard-content">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="tipo_estudio">Tipo de estudios:<span class="danger">*</span> </label>
                                                  <select class="custom-select form-control" id="tipo_estudio" name="tipo_estudio">
                                                    <option value="">*Seleccionar*</option>
                                                    <option value="">Secundaria completa</option>
                                                    <option value="">Técnico superior</option>
                                                    <option value="">Universitario</option>
                                                    <option value="">Maestría</option>
                                                    <option value="">Doctorado</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nivel_estudios">Nivel de estudios:<span class="danger">*</span> </label>
                                                <select class="custom-select form-control" id="nivel_estudios" name="nivel_estudios">
                                                  <option value="">*Seleccionar*</option>
                                                  <option value="">Estudiante</option>
                                                  <option value="">Egresado</option>
                                                  <option value="">Bachiller</option>
                                                  <option value="">Titulado</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="carreraProfesional">Carrera Profesional/Mención:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="carreraProfesional" name="carreraProfesional" > 
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="centro_estudio">Centro de Estudio:<span class="danger">*</span> </label>
                                                <input type="text" class="form-control required" id="centro_estudio" name="institucion" > 
                                            </div>
                                        </div>
                                     </div>
                                      
                                      
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fecha">Fecha: <span class="danger">**</span> </label>
                                                <input type="text" class="form-control required" id="fecha" name="fecha" > 
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
                                            <label for="wemailAddress2"><small>(*) Indica un campo obligatorio</small> </label>
                                            <label for="wemailAddress2"><small>(**)En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</small> </label>
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
 