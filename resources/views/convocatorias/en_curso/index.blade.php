@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection

@section('title','Ajustes')

@section('menu_title_1','Convocatorias vigentes')
@section('menu_title_2','Vigentes')

@section('content')
                        <div class="card">
                            <div class="card-body">
                            {{-- modal --}}
                                                       
                          
                                @if(auth()->check() && auth()->user()->hasRoles(['Administrador']))
                                   
                            {{--Fin modal --}}

            <h4 class="card-title">
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="modal" data-target="#modal_nuevo">
                <i class="fa fa-plus"></i> Nuevo</button>
            </h4>
            @endif
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="">
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
                        <tfoot  class="">
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