<!-- Modal -->
<div class="modal fade" id="m_cambioCorreo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
              <h5 class="modal-title modal-colored-header bg-success" >Cambio de Correo Electrónico</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
  
          <form novalidate class="m_cambioCorreo">
              
              <div class="modal-body">
              
                  <div class="form-group">
                      <label class="text-primary">Ingrese el nuevo correo electrónico: </label>
                      <input id="id_correonuevo"  type="email"  class="form-control " required >
                      <div class="invalid-feedback">
                          Es necesario que complete este campo
                      </div>
                  </div>
                  
              </div>        
              <div class="modal-footer">
                  <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button id="btn_cambio_correo"  class="btn btn-success" type="button">Cambiar correo eletrónico</button>
              </div>
          </form>
      </div>
    </div>
  </div>
  <!-- fin modal -->