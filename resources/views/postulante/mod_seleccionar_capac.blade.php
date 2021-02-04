<!-- Full width modal content -->
<div id="modal_selec_capac" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header bg-success">
             <h4 class="modal-title text-white" id="fullWidthModalLabel">Seleccionar Cursos / Capacitaciones</h4>
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
                               
                                <div class="table-responsive">
                                    <table id="zero_config2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo de estudio</th>
                                                <th>Descripción</th>
                                                <th>Institución</th>
                                                <th>Horas lectivas<br></th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <!-- Cuerpo vacio -->
                                                @foreach ($datos_capacitacion as $dc)
                                                <tr>
                                                    <td class="text-center"><input style="width: 20px; height: 20px" value="{{$dc->id}}" type="checkbox" /></td>
                                                    <td>falta tipo estudio</td>
                                                    <td>{{$dc->especialidad}}</td>
                                                    <td>{{$dc->centro_estudios}}</td>
                                                    <td>{{$dc->cantidad_horas}}</td>
                                                    
                                                    
                                                </tr>
                                                @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div>
                                    
                                </form>
                          </div>
                      </div>
                  </div>

                  <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
             {{-- wizard FIN--}}
             <div class="text-center">
                <button id="btnguardarcapac" class="btn btn-group btn-success">Guardar</button>
            </div>
            </div>
                
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 