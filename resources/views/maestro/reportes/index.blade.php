@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->

<link href="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('title','Maestro - reportes')

@section('menu_title_1','Reportes')
@section('menu_title_2','Reportes')

@section('content')

<div class="card">
     <div class="card-body">
     	<form>	
     	<div class="row">
     			
	     		<div class="col-md-4">
	        		<h4>Lista de ganadores por fecha de aprobación de convocatoria: </h4>
	        	</div>
	        	<div class="col-md-3">
	        		<input type="date" value="" class="form-control required" id="fecha_publicacion" onchange="crearUrl(event)" required>
	        	</div>
	        	<div class="col-md-3">
	        		<a href="#" id="url_descarga" class="btn btn-block btn-success">Descargar</a>
	        	</div>
        		
        </div>
        
    </div> 
</div>                    
@endsection
@section('js')
<!--This page plugins -->
    <script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/meg.init.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>

    <script type="text/javascript">
    		function crearUrl(){
			//alert(event.target.value)
			document.getElementById('url_descarga').href="/maestro/reportes/reporteganadores/"+event.target.value
			}
    </script>

@endsection