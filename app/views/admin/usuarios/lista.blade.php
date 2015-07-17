@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<table border="1" class=" table">

<tr>
  <th>Nombre</th>
  <th>Usuario</th>
</tr>

@foreach($usuarios as $usuario)
<tr>
  <th>{{$usuario->nombre}}</th>
  <th>{{$usuario->login}}</th>
</tr>

@endforeach

</table>


@stop
