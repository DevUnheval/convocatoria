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
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead class="bg-success text-white">
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
                        <tfoot class="bg-success text-white">
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
    <script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>

    <script src="{{ asset('/material-pro/src/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('/js/convocatorias.js')}}"></script>

    <script>
    $(document).ready(function(){
        $(".check_conocimientos").change(function() {
            if(this.checked) {
                $(".fila_conocimiento").prop("disabled", false);
                $(".fila_conocimiento").prop('required',true);
            }else{
                $(".fila_conocimiento").prop("disabled", true);
                $(".fila_conocimiento").prop('required',false);
                //$(".fila_conocimiento").removeAttr( "required" );
            }
        });
        
        $('.form-check-input').on('change', function() {
           
            //alert( valor);
            var valor   =  $(this).val();
            var $div    =  "#"+$(this).data("id_div");
            var $nombre =  $(this).data("name");
            var $id     =  $(this).data("id");
            if(valor =="1"){
                if($id=="n_archivo_bases" || $id=="n_archivo_resolucion"){
                    $($div).html('<input type="file" class="form-control-file required '+$nombre+'" id="'+$id+'" name="'+$id+'">'); //es necesario ponerle atributo name, sino no agarra el required...
                }else{
                     $($div).html('<input type="file" class="form-control-file '+$nombre+'"  id="'+$id+'">'); //... y le mandamos un name que no esté en BD, así no pasa nada
                }
                
                
            } else if (valor == "0"){ 
                $($div).html('<input type="url" class="form-control required '+$nombre+'" name="'+$id+'" id="'+$id+'" placeholder="Ingrese el link">');      
                $($div+" input").focus();
            } else { 
                $($div).html('No se seleccionó');      
            }
        });
    });
    </script>
   
@endsection