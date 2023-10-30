@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection

@section('title','Maestro - usuarios')

@section('menu_title_1','Usuarios vigentes')
@section('menu_title_2','Usuarios')

@section('content')
                        <div class="card">
                            <div class="card-body">
                            @include('maestro.usuarios.editar')
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Conf.</th>
                                                <th>Id</th>
                                                <th>CV</th>
                                                <th>DNI</th>
                                                <th>Nombres y Apellidos</th>
                                                <th>Foto</th>
                                                <th>Roles</th>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <!-- Cuerpo vacio -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Conf.</th>
                                                <th>Id</th>
                                                <th>CV</th>
                                                <th>DNI</th>
                                                <th>Nombres y Apellidos</th>
                                                <th>Foto</th>
                                                <th>Roles</th>
                                                
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
    <script src="{{ asset('/js/maestro_usuarios.js')}}"></script>


   
@endsection
