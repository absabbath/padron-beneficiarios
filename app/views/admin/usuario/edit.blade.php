@extends('admin-layout')

@section('content') 

@section('ruta')

 <ol class="breadcrumb">
    <li><a href=" {{URL::to('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="{{ URL::to('admin/usuario')}}"><i class="fa fa-user"></i> Usuarios</a></li>
    <li class="active">Editar usuario {{$usuario->login}}</li>
</ol>

@stop

@if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Por favor corrige los siguentes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
<div class="col-md-4"></div>

<div class="col-md-4">

{{ Form::model($usuario, array('route' => array('admin.usuario.update', $usuario->id), 'method' => 'PUT'), array('role' => 'form')) }}

		{{ Form::label('login', 'Nombre de usuario', array('class'=>'control-label')) }}
		{{ Form::text('login', $usuario->login, array('placeholder' => 'Usuario', 'class' => 'form-control')) }}

        {{ Form::label('email', 'Correo electronico',array('class'=>'control-label')) }}
        {{ Form::text('email', $usuario->email, array('placeholder' => 'Correo electronico', 'class' => 'form-control')) }}

        {{ Form::label('nombre', 'Nombre',array('class'=>'control-label')) }}
        {{ Form::text('nombre', $usuario->nombre, array('placeholder' => 'Nombre del usuario', 'class' => 'form-control')) }}

        {{ Form::label('primer_apellido', 'Primer apellido',array('class'=>'control-label')) }}
        {{ Form::text('primer_apellido', $usuario->primer_apellido, array('placeholder' => 'Primer apellido', 'class' => 'form-control')) }}

        {{ Form::label('segundo_apellido', 'Segundo apellido',array('class'=>'control-label')) }}
        {{ Form::text('segundo_apellido', $usuario->segundo_apellido, array('placeholder' => 'Segundo Apellido', 'class' => 'form-control')) }}
        
        {{ Form::label('id_rol', 'Perfil de usuario',array('class'=>'control-label')) }}
        {{ Form::select('id_rol', $roles, $usuario->id_rol, ['class' => 'form-control']) }}

        {{ Form::label('id_dependencia', 'Dependencia a la que pertenece',array('class'=>'control-label')) }}
        {{ Form::select('id_dependencia', $dependencias, $usuario->id_dependencia, ['class' => 'form-control']) }}
	
		<br>

		<center> {{ Form::button('Guardar Usuario', array('type' => 'submit', 'class' => 'btn btn-success')) }}</center>
        
   
	{{ Form::close() }}

</div>
@stop