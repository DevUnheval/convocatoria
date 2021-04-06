@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection

@section('title','Convocatorias canceladas')

@section('menu_title_1','Convocatorias canceladas')
@section('menu_title_2','Histórico > Canceladas')

@section('content')
                        <div class="card">
                            <div class="card-body">
                            {{-- modal --}}
                            @include('convocatorias.vigentes.m_comunicados')
                            {{--Fin modal --}}
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="text-white" style="background-color:#1e94c2;">
                            <tr>
                              
                                <th>Código</th>
                                <th>Convocatoria</th>
                                <th>Comunicados</th>                                
                                <th>Evaluacion</th>
                                <th>Resultados</th>
                            </tr>
                        </thead>
                        <tbody>
                                <!-- Cuerpo vacio -->
                        </tbody>
                        <tfoot  class="text-white" style="background-color:#1e94c2;">
                            <tr>
                                
                                <th>Código</th>
                                <th>Convocatoria</th>
                                <th>Comunicados</th>                                
                                <th>Evaluacion</th>
                                <th>Resultados</th>                              
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

@endsection
@section('js')
<!--This page plugins -->
    <script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>

    <script src="{{ asset('/material-pro/src/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('/js/convocatorias/historico_cancelados.js')}}"></script>
@endsection