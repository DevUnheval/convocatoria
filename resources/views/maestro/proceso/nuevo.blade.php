 <!--  Modal content for the above example -->
 <div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog"
 aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-sm">
     <div class="modal-content">
        
         <div class="modal-header d-flex align-items-center">
             <h4 class="modal-title" id="myLargeModalLabel">Nuevo</h4>
             <button type="button" class="close ml-auto" data-dismiss="modal"
                 aria-hidden="true">×</button>
         </div>
        <form id="nuevo_formaulario">
         <div class="modal-body">
            <div class="form-group">
                <label>Nombrex:</label>
                <input type="text" class="form-control" name="nombre" id="id_nombre">
                
            </div>
            <div class="form-group">
                <label >Descripción:</label>
                <textarea class="form-control"  name="descripcion" id="id_descripcion"></textarea>
                
            </div>
         </div>
         </form>

         <div class="modal-footer">
            <button type="button" class="btn btn-block btn-success" id="guardar_nuevo">Guardar</button>
         </div>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


 