@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Home</h3>
  </div>
  <div class="panel-body">
  	<br>
    <p class="bg-danger">Asignacion de apoyos</p>
    <p class="bg-warning">Reportes</p>
    <p class="bg-danger">Control de dependencias</p>
    <p class="bg-warning">Control de programas</p>
	<br>
  </div>
</div>

@stop
