@extends('layouts.material')
@section('css')
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="zero_config" data-url="/mispostulaciones/datatabla">
                <thead class="text-white" style="background-color:#1e94c2;">
                    <tr>
                        <th>Código</th>
                        <th>Convocatoria</th>
                        <th>Nº de plazas</th>
                        <th>Fecha de<br> postulación</th>
                        <th>Información / Bases </th>
                        <th>Comunicados</th>
                        <th>Evaluaciones</th>
                        <th>Resultado</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                    
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>
<script src="{{ asset('/js/mispostulaciones.js')}}"></script>
@endsection