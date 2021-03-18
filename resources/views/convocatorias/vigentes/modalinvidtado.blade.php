<!-- Info Header Modal -->
<div id="modal_invitado" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="info-header-modalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header modal-colored-header bg-info">
            <h4 class="modal-title text-white" id="info-header-modalLabel">Importante</h4>
            <button type="button" class="close ml-auto" data-dismiss="modal"
                aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            
            <p>Es necesario que inicie sesión para que pueda postular.</p>
            
        </div>
        <div class="modal-footer">
            <button onclick="location.href = '{{ route('login') }}'" type="button" class="btn btn-info">Iniciar Sesión</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->