@extends('layouts.material')

@section('css')
@endsection
@section('title','Ajustes')
@section('menu_title_1','Nombre Menu')
@section('menu_title_2','Nombre_Menu')
@section('content')
<div class="card">
   <div class="card-body">
      <form method="POST" action="{{ route('maestro.ajustes.update') }}" enctype="multipart/form-data">
                        @csrf
      <div class="row">
      <div class="col-sm-6">
         <button type="submit" class="btn btn-success">Guardar cambios</button>
      </div>
      <div class="col-sm-6" alingn="right">
         <a href="{{ route('maestro.ajustes.restablecer')}}" onclick="return confirmacion_eliminar()">restablecer</a>
      </div>
            
      <div class="col-12"><hr><br></div>

      
      
      @foreach($ajustes as $a)
         
         <div class="col-md-4">
            <h3>{{ $a->nombre}}</h3>
            <label>{{ $a->descripcion }}</label>
         </div>
         <div class="col-md-8">
            @switch($a->tipo)
               @case('texto') <input type="text" name="elemento_{{$a->id}}" class="form-control" value="{{ $a->valor }}" required> @break
               @case('imagen') 
               <?php $ruta_img='';
                  if(substr($a->valor, 0,6)=='public') $ruta_img=Storage::url($a->valor);
                  else $ruta_img= $a->valor;
                  list($ancho, $alto, $type, $attr)=getimagesize(substr($a->valor, 0,6)=='public'?substr(Storage::url($a->valor),1):$a->valor);
               ?>
                  <div>
                     <img src="{{substr($a->valor, 0,6)=='public'?Storage::url($a->valor): asset($a->valor)}}" style="max-width: 500px;" 
                     width="{{$a->id>5?'100%':'10%'}}">
                     <br><label><small>{{$attr}}</small></label>
                  </div>
                  <input type="file" name="elemento_{{$a->id}}" accept="image/*">
                  
                @break
               @case('archivo_ruta') <input type="url" name="elemento_{{$a->id}}" value="{{ $a->valor }}" class="form-control" required>
                  <a href="{{ url($a->valor) }}" target="_blank">Abrir el enlace</a> @break
               
               @case('booleano') 
                  <div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input material-inputs" type="radio"  name="elemento_{{$a->id}}" id="elemento_si_{{$a->id}}" value="1" {{$a->valor=='1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="elemento_si_{{$a->id}}">SI</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input material-inputs" type="radio"  name="elemento_{{$a->id}}" id="elemento_no_{{$a->id}}" value="0" {{$a->valor=='0' ? 'checked' : ''}}>
                        <label class="form-check-label" for="elemento_no_{{$a->id}}">NO </label>
                     </div>
                  </div>
               @break

               @default <span>Valor no reconocido</span> @break

            @endswitch
         </div>
         <div class="col-12"><hr><br></div>
      @endforeach  
      </div>
      <button type="submit" class="btn btn-success">Guardar cambios</button>
      </form>
   </div>

</div>
@endsection
@section('js')

{{-- Ajustes de vista --}}
@endsection
