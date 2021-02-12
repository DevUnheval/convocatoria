 <!--  Modal content for the above example -->
 <div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog"
 aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-sm">
     <div class="modal-content">
        <form id="formulario_nuevo">
         <div class="modal-header d-flex align-items-center">
             <h4 class="modal-title" id="myLargeModalLabel">Editar</h4>
             <button type="button" class="close ml-auto" data-dismiss="modal"
                 aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nuevo_nombre" class="form-control" name="nombre">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="nuevo_descripcion"  name="descripcion"></textarea>
            </div>
         </div>
         </form>
         <div class="modal-footer">
            <button class="btn btn-block btn-success" id="guardar_nuevo">Guardar cambios</button>
         </div>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->