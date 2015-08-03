@extends('admin-layout')

@section('content') 

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
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

{{ Form::open(array('action' => 'UsuarioController@store', 'method' => 'POST'), array('role' => 'form','class'=>'form-horizontal row-fluid')) }}
              

		{{ Form::label('login', 'User',array('class'=>'control-label')) }}
		{{ Form::text('login', null, array('placeholder' => 'Usuario', 'class' => 'form-control')) }}
	

		<br>

		<center> {{ Form::button('Guardar Usuario', array('type' => 'submit', 'class' => 'btn btn-success')) }}</center>
        
   		

	{{ Form::close() }}


@stop