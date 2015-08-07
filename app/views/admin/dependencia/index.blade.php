@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
    <li class="active">Dependencias</li>
</ol>

@stop

<br>

	<center><a href="{{ URL::to('admin/dependencia/create') }}" class="btn btn-danger" type="button">Nueva Dependencia</a></center><br>
<div class="col-md-4"></div>
<div class="col-md-6">
<table class="table table-condensed">
<tr>
	<td bgcolor='#DCDCDC' >NOMBRE DEPENDENCIA</td>
	<td bgcolor='#DCDCDC'>NOMBRE DIRECTOR</td>
	<td bgcolor='#DCDCDC'>PRIMER APELLIDO</td>
	<td bgcolor='#DCDCDC'>SEGUNDO APELLIDO</td>
</tr>
@foreach($dependencias as $dependencia)
<tr>

	<td><a href="{{ route('admin.dependencia.edit', $dependencia->id) }}">{{$dependencia->nombre_dependencia}}</a></td>
	<td>{{$dependencia->nombre_director}}</td>
	<td>{{$dependencia->primer_apellido}}</td>
	<td>{{$dependencia->segundo_apellido}}</td>

	
</tr>

@endforeach

</table>
</div>

@stop
