@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

<link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('/material-pro/src/assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
@endsection

@section('title','Maestro - formación')

@section('menu_title_1','Formacion Academica')
@section('menu_title_2','Formacion')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">
            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="modal" data-target="#modal_nuevo">
            <i class="fa fa-plus"></i> Nuevo</button>
        </h4>
        @include('maestro.formacion.editar')
        @include('maestro.formacion.nuevo')                        
            <div class="table-responsive">
                <table id="data_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Conf.</th>
                            <th>Id</th>                                                
                            <th>Nombre</th>
                            <th>Descripción</th>                                                
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
                            <th>Nombre</th>
                            <th>Descripción</th> 
                            
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
    <script src="{{ asset('/js/maestro_formacion.js')}}"></script>
@endsection
