@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection

@section('title','Convocatorias vigentes')

@section('menu_title_1','Convocatorias vigentes')
@section('menu_title_2','Vigentes')

@section('content')
                        <div class="card">
                            <div class="card-body">
                            {{-- modal --}}
                            
                            @include('convocatorias.vigentes.m_ver')
                            @include('convocatorias.vigentes.m_comunicados')
                            @include('convocatorias.vigentes.modalinvidtado')
                                @if(auth()->check() && auth()->user()->hasRoles(['Administrador']))
                                    @include('convocatorias.vigentes.m_nuevo')
                                    @include('convocatorias.vigentes.m_editar')
                            {{--Fin modal --}}

            <h4 class="card-title">
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="modal" data-target="#modal_nuevo">
                <i class="fa fa-plus"></i> Nuevo</button>
            </h4>
            @endif
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered" data-url="/convocatorias/vigentes/data">
                        <thead class="text-white" style="background-color:#1e94c2;">
                            <tr>
                                @if(auth()->check() && auth()->user()->hasRoles(['Administrador']))
                                <th>Conf.</th>
                                @endif
                                <th>Código</th>
                                <th>Convocatoria</th>
                                <th>Nº <br>plazas</th>
                                <th>Inscripción<br> (inicio - fin)</th>
                                <th>Comunicados</th>
                                <th>Bases</th>
                                <th>
                                    @if(auth()->check() && auth()->user()->hasRoles(['Administrador','Comisionado']))
                                        Postulantes
                                    @else
                                        Postular
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                <!-- Cuerpo vacio -->
                        </tbody>
                        <tfoot class="text-white"style="background-color:#1e94c2;">
                            <tr>
                                @if(auth()->check() && auth()->user()->hasRoles(['Administrador']))
                                <th>Conf.</th>
                                @endif
                                <th>Código</th>
                                <th>Convocatoria</th>
                                <th>Nº <br>plazas</th>
                                <th>Inscripción <br>(inicio - fin)</th>
                                <th>Comunicados</th>
                                <th>Bases</th>
                                <th>
                                    @if(auth()->check() && auth()->user()->hasRoles(['Administrador','Comisionado']))
                                        Postulantes
                                    @else
                                        Postular
                                    @endif
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

@endsection
@section('js')
<!--This page plugins -->
    <script>
        var pesoMaxArchivo = '{{ $datos["pesoMaxArchivo"] }}'; 
        var pesoMaxArchivo_MB = pesoMaxArchivo/1048576;
            pesoMaxArchivo_MB = pesoMaxArchivo_MB.toFixed(1); 
     </script>
    <script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('/js/convocatorias/convocatoria.js')}}"></script>
    <script src="{{ asset('/js/convocatorias/vigentes.js')}}"></script>
    <script src="{{ asset('/js/validar_peso_archivo.js')}}"></script>
    
   
@endsection