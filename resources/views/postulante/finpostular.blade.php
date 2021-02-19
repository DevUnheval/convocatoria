@extends('layouts.material')

@section('css')
@endsection

@section('content')
Estas postulando al proceso {{$proceso->cod}}<br>
Sr(a): {{$datos_usuario->nombres}} {{$datos_usuario->apellido_paterno}} {{$datos_usuario->apellido_materno}}<br>
RUC: {{$datos_usuario->ruc}}<br>
Se ha enviado una contancia de su postulación al correo registrado <strong>{{$datos_usuario->email}}</strong><br>
Puede ver su postulación ingresando <a href="#">Aquí</a>

@endsection