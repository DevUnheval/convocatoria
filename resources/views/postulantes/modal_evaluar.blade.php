<div class="modal fade" id="modal_evaluar" tabindex="-1" role="dialog"
   aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="mySmallModalLabel">Ev. {{$etapa_actual['descripcion']}}</h4>
                <button type="button" class="close ml-auto" data-dismiss="modal"
                  aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="p-3 bg-light">
                    <div align="center">
                        <img id="img_ev_individual" width="60%" onerror="this.src='/imagenes/users/user.png';">
                    </div>
                    <small> DNI: </small>
                    <h5 id="dni_ev_individual">0000</h5>
                    <small> Nombres y Apellidos: </small>
                    <h5 id="nombres_ev_individual"> NOMBRES Y APEELIDOS</h5>
                </div>
                <hr>

                <form id="form_ev_individual" action="javascript:void(0);">
                    <div class="form-group">
                        <label>Puntaje [{{(int)$proceso->$ptj_min}} - {{(int)$proceso->$ptj_max}}]</label>
                        <input type="number"  class="form-control" id="input_puntaje_ev_individual" placeholder="Puntaje"min="0" max="{{$proceso->$ptj_max}}" required>
                    </div>
                    <div class="form-group" id="ev_bonificacion_deportista">
                        
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea class="form-control" id="textarea_puntaje_ev_individual" rows="4" placeholder="No hay observaciones..."></textarea>
                      </div>
                        <button type="button" class="btn btn-success btn-block btn_guardar_evaluacion" id="btn_guardar_ev_individual" 
                        data-id_formulario="form_ev_individual"> <i class=" far fa-save"></i> Guardar </button>
                  </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
