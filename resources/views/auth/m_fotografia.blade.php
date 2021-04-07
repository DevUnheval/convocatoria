<!-- Modal -->
<div class="modal fade" id="m_fotografia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title modal-colored-header bg-success" >Actualizar Fotografía</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <center>
            <br>    
            <img id="fotografia" src="{{ asset(str_replace('public/','storage/',Auth::user()->img))}}" alt="user" class="rounded-circle" width="150" height="150">
            <div class="card-body align-content-center">
                <h4 class="card-title mt-2">{{auth()->user()->nombres.' '.auth()->user()->apellido_paterno.' '.auth()->user()->apellido_materno}}</h4>
            </div>
            <label ><small>Tamaño máximo de archivo {{$pesoMaxArchivo_c}} MB</small> </label>
            <input type="file" id="file_foto" accept="image/*" onchange="validar_peso_archivo(this)">
            </center>  

            <div class="modal-footer">
                <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="btn_update_foto"  class="btn btn-success "type="button">Actualizar</button>
            </div>
          
      </div>
    </div>
  </div>
  <!-- fin modal -->