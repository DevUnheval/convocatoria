<!-- Modal -->
<div class="modal fade" id="m_contraseña" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <h5 class="modal-title modal-colored-header bg-success" >Modificar Contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="" method="post" novalidate>
            <div class="modal-body">
                <div class="form-group">
                    <label class="text-primary">Contraseña anterior: </label>
                    <input type="password" class="form-control" required data-validation-required-message="This field is required">
                    <div class="invalid-feedback">
                        Ingrese un correo válido
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-info">Nueva Contraseña: </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                    <div class="invalid-feedback">
                        Ingrese un correo válido
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-info">Confirme Contraseña: </label>
                    <input type="password" class="form-control" required id="password-confirm" name="password_confirmation">
                    <div class="invalid-feedback">
                        Complete este campo
                    </div>
                </div>
            </div>        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success "type="submit">Actualizar</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- fin modal -->