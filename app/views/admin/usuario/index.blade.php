@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<br>

	<center><a href="{{ URL::to('admin/usuario/create') }}" class="btn btn-danger" type="button">Nuevo Usuario</a></center><br>

<table class="table table-condensed">
<tr>
	<td bgcolor='#DCDCDC' >USUARIO</td>
	<td bgcolor='#DCDCDC' >EMAIL</td>
	<td bgcolor='#DCDCDC' >NOMBRE</td>
	<td bgcolor='#DCDCDC' >PRIMER APELLIDO</td>
	<td bgcolor='#DCDCDC' >SEGUNDO APELLIDO</td>
	<td bgcolor='#DCDCDC' >ROL</td>
	<td bgcolor='#DCDCDC' >DEPENDENCIA</td>
	
</tr>
@foreach($users as $usuario)
<tr>

	<td><a href="{{ route('admin.usuario.edit', $usuario->id) }}">{{$usuario->login}}</a></td>
	<td>{{$usuario->email}}</td>
	<td>{{$usuario->nombre}}</td>
	<td>{{$usuario->primer_apellido}}</td>
	<td>{{$usuario->segundo_apellido}}</td>
	<td>{{$usuario->rol()->first()->name}}</td> 
	@if($usuario->dependencia()->first() != null)
		<td>
			{{$usuario->dependencia()->first()->nombre_dependencia}}
		</td>
	@else
		<td>
			Sin usuario asignado
		</td>
	@endif
	
</tr>

@endforeach

</table>

@stop
