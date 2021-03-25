@extends('layouts.material')

@section('css')
<!-- This page plugin CSS -->

<link href="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('title','Maestro - procesos')

@section('menu_title_1','Procesos vigentes')
@section('menu_title_2','Procesos')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">
            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="modal" data-target="#modal_nuevo">
            <i class="fa fa-plus"></i> Nuevo</button>
        </h4>
        @include('maestro.proceso.editar')
        @include('maestro.proceso.nuevo')                        
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
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/meg.init.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('/js/maestro_tipoprocesos.js')}}"></script>}

 <script>
        function openModal(){
            $('#modal_nuevo').modal('show')
        }
    
    </script>  
    @endsection

