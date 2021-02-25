@extends('layouts.material')
@section('content')
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="text-white bg-info">
            <tr>
                <th>Código</th>
                <th>Convocatoria</th>
                <th>Fecha de<br> postulación</th>
                <th>Comunicados</th>
                <th>Evaluación<br> Curricular</th>
                <th>Evaluación<br> Conocimiento</th>
                <th>Entrevista<br> Personal</th>
                <th>Estado</th>
                
            </tr>
        </thead>
                <tbody id="mispostulaciones">
                    
                </tbody>
              
    </table>
</div>
@endsection
@section('js')
<script src="{{ asset('/js/mispostulaciones.js')}}"></script>
    
@endsection