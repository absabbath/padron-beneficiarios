@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Admin</li>
</ol>

@stop

<h1>Aqui van todas las configuraciones que se puedan mostrar como administrador</h1><br>

<h3><span class="label label-info">Subir padron</span></h3>
<input type="file" name="upPadron"/>


@stop
