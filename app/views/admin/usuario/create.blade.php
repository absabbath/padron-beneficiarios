@extends('admin-layout')

@section('content') 

@section('ruta')

 <ol class="breadcrumb">
    <li><a href=" {{URL::to('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="{{ URL::to('admin/usuario')}}"><i class="fa fa-user"></i> Usuarios</a></li>
    <li class="active">Nuevo</li>
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

{{ Form::open(array('action' => 'UsuarioController@store', 'method' => 'POST'), array('role' => 'form','class'=>'form-horizontal row-fluid')) }}
              

		{{ Form::label('login', 'Nombre de usuario', array('class'=>'control-label')) }}
		{{ Form::text('login', null, array('placeholder' => 'Usuario', 'class' => 'form-control')) }}

        {{ Form::label('email', 'Correo electronico',array('class'=>'control-label')) }}
        {{ Form::text('email', null, array('placeholder' => 'Correo electronico', 'class' => 'form-control')) }}

        {{ Form::label('nombre', 'Nombre',array('class'=>'control-label')) }}
        {{ Form::text('nombre', null, array('placeholder' => 'Nombre del usuario', 'class' => 'form-control')) }}

        {{ Form::label('primer_apellido', 'Primer apellido',array('class'=>'control-label')) }}
        {{ Form::text('primer_apellido', null, array('placeholder' => 'Primer apellido', 'class' => 'form-control')) }}

        {{ Form::label('segundo_apellido', 'Segundo apellido',array('class'=>'control-label')) }}
        {{ Form::text('segundo_apellido', null, array('placeholder' => 'Segundo Apellido', 'class' => 'form-control')) }}
        
        {{ Form::label('id_rol', 'Perfil de usuario',array('class'=>'control-label')) }}
        {{ Form::select('id_rol', $roles, null, ['class' => 'form-control']) }}

        {{ Form::label('id_dependencia', 'Dependencia a la que pertenece',array('class'=>'control-label')) }}
        {{ Form::select('id_dependencia', $dependencias, null, ['class' => 'form-control']) }}
	
		<br>

		<center> {{ Form::button('Guardar Usuario', array('type' => 'submit', 'class' => 'btn btn-success')) }}</center>
        
   
	{{ Form::close() }}

</div>
@stop