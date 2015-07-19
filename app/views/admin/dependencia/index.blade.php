@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<br>

	<a href="{{ URL::to('admin/dependencia/create') }}" class="btn btn-default btn-warning" type="button">Ir a: Nueva Dependnecia</a>


<table>
<tr>
	<td>NOMBRE DEPENDENCIA</td>
	<td>NOMBRE DIRECTOR</td>
	<td>PRIMER APELLIDO</td>
	<td>SEGUNDO APELLIDO</td>
	<td>EDITAR</td>
</tr>
@foreach($dependencias as $dependencia)
<tr>

	<td>{{$dependencia->nombre_dependencia}}</td>
	<td>{{$dependencia->nombre_director}}</td>
	<td>{{$dependencia->primer_apellido}}</td>
	<td>{{$dependencia->segundo_apellido}}</td>

	<td><a class="btn btn-success" href="{{ route('admin.dependencia.edit', $dependencia->id) }}">
              editar
            </a></td>
	
</tr>

@endforeach

</table>


@stop
