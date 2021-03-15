<!-- Full width modal content -->
<div id="modal_evaluar_todos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header bg-danger" >
               <h4 class="modal-title text-white"id="fullWidthModalLabel">Evaluacion TODOS</h4>
               <button type="button" class="close btn-light" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                 <!-- ============================================================== -->
                    <!-- Example -->
                    <!-- ============================================================== -->
                    <div class="col-12">
                        <div class="card">
                            <!-- Inicio de los Tabs -->
                            <div class="card-body">
                                <div class="form-group bg-light py-1 px-3">
                                    <h5 class="card-title mb-2"> PROCESO: {{$proceso->cod}} - {{$proceso->nombre}}</h5>
                                    <h5 class="card-title mb-2"> ETAPA DE EVALUACIÓN: {{$etapa_actual["descripcion"]}}</h5><hr>
                                    <p class="mb-2"> PUNTAJE MÁXIMO: {{(int)$proceso->$ptj_max}}</p>
                                    <p class="mb-2"> PUNTAJE MÍNIMO: {{(int)$proceso->$ptj_min}}</p>
                                    <small class="text-danger">NOTA: Si el postulante no alcanza o supera el puntaje mínimo NO continuará en las siguientes evalauciones</small>
                                </div><hr>
                                
                                <form id="form_postulantes_evaluados">                           
                                    <table id="postulantes_evaluados" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>
                                                <th>DNI</th>
                                                <th>Apellidos y Nombres</th>
                                                <th>Puntaje <br> [{{(int)$proceso->$ptj_min}} - {{(int)$proceso->$ptj_max}}]</th>
                                                <th>Observaciones / Apuntes</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nº</td>
                                                <td>DNI</td>
                                                <td>Apellidos y Nombres</td>
                                                <th>Puntaje <br> [{{(int)$proceso->$ptj_min}} - {{(int)$proceso->$ptj_max}}]</th>
                                                <th>Observaciones / Apuntes</th>
                                            <tr>
                                        </tbody>
                                    </table>         
                                </form>
                            </div>
                            
                        </div>
                    </div>              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn_guardar_evaluacion" id="btn_guardar_evaluacion" data-id_formulario="form_postulantes_evaluados">Guardar cambios</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}
               