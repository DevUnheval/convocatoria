<!-- Modal -->
<div class="modal fade" id="m_contraseña" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <h5 class="modal-title modal-colored-header bg-success" >Modificar Contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form novalidate class="needs-validation10">
            
            <div class="modal-body">
            <div id="mensaje-alert">
                
            </div>
                <div class="form-group">
                    <label class="text-primary">Contraseña anterior: </label>
                    <input id="mypassword" type="password" name="mypassword" class="form-control " required >
                    <div class="invalid-feedback">
                        Es necesario que complete este campo
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-info">Nueva Contraseña: </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                    <div class="invalid-feedback">
                        Es necesario que complete este campo
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-info">Confirme Contraseña: </label>
                    <input type="password" class="form-control" required id="password_confirmation" name="password_confirmation">
                    <div class="invalid-feedback">
                        Es necesario que complete este campo
                    </div>
                </div>
            </div>        
            <div class="modal-footer">
                <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="btn_update_pass"  class="btn btn-success "type="button">Actualizar</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- fin modal -->