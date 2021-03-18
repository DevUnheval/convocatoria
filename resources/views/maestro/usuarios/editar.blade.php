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
                <div class="content " style="padding:10px">
                <form action="#" id="editar_usuario">
                    <h6><strong>Datos del Usuario</strong></h6>
                    <div class="row" >                      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b><small for="dni">DNI:<span class="text-danger"> *</span> </small></b>
                                    <input type="text" class="form-control" id="dni" name="dni">
                                </div>
                            </div>                     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small >Nombres:<span class="text-danger"> *</span> </small>
                                    <input type="text" class="form-control" id="nombres" name="nombres"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <small>Apellido Paterno:<span class="text-danger"> *</span> </small>
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno"> 
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <small>Apellido Materno:<span class="text-danger"> *</span> </small>
                                <input type="text" class="form-control required" id="apellido_materno" name="apellido_materno"> 
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <small>Contraseña:<span class="text-danger"> *</span> </small>
                                <input type="password" class="form-control" name="password" placeholder="(opcional)"> 
                            </div>
                            </div>
                    </div>
                    <h4 class="card-title mt-4">Roles</h4>
                    <div class="row">
                        @foreach($roles as $key => $rol)
                        <div class="col-md-3">
                            <input type="checkbox" id="rol_checkbox_{{$key}}" value="{{$key}}" class="material-inputs chk-col-amber check_rol" name="roles[]" />
                            <label for="rol_checkbox_{{$key}}">{{$rol}}</label>
                        </div>
                        @endforeach     
                        <input type="hidden" id="id" name="id"> 
                    </div><br>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="guardar_cambio()">Guardar cambioss</button>
            </div>
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
 {{-- Modal End --}}
             