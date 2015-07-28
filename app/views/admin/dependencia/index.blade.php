@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<br>

	<center><a href="{{ URL::to('admin/dependencia/create') }}" class="btn btn-danger" type="button">Nueva Dependencia</a></center><br>

<table class="table table-condensed">
<tr>
	<td bgcolor='#DCDCDC' >NOMBRE DEPENDENCIA</td>
	<td bgcolor='#DCDCDC'>NOMBRE DIRECTOR</td>
	<td bgcolor='#DCDCDC'>PRIMER APELLIDO</td>
	<td bgcolor='#DCDCDC'>SEGUNDO APELLIDO</td>
	<td bgcolor='#DCDCDC'>EDITAR</td>
</tr>
@foreach($dependencias as $dependencia)
<tr>

	<td>{{$dependencia->nombre_dependencia}}</td>
	<td>{{$dependencia->nombre_director}}</td>
	<td>{{$dependencia->primer_apellido}}</td>
	<td>{{$dependencia->segundo_apellido}}</td>

	<td><a class="btn btn-success" href="{{ route('admin.dependencia.edit', $dependencia->id) }}">Editar</a></td>
	
</tr>

@endforeach

</table>


@stop
