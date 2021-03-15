<div class="modal fade" id="modal_evaluar" tabindex="-1" role="dialog"
   aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="mySmallModalLabel">Evaluacion Individual</h4>
                <button type="button" class="close ml-auto" data-dismiss="modal"
                  aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form_ev_individual">
                    <div class="form-group">
                        <label>Evaluación NombreEvaluacion</label>
                        <input type="number"  class="form-control" id="input_puntaje_ev_individual" placeholder="Puntaje"min="0" max="{{$proceso->$ptj_max}}" required>
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea class="form-control" id="textarea_puntaje_ev_individual"></textarea>
                      </div>
                        <button type="button" class="btn btn-success btn-block btn_guardar_evaluacion" id="btn_guardar_ev_individual" 
                        data-id_formulario="form_ev_individual"> <i class=" far fa-save"></i> Guardar </button>
                  </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->