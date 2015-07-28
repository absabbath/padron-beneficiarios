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



{{ Form::model($dependencia, array('route' => array('admin.dependencia.update', $dependencia->id), 'method' => 'PUT'), array('role' => 'form')) }}

		{{ Form::label('nombre_dependencia', 'Dependencia',array('class'=>'control-label')) }}
		{{ Form::text('nombre_dependencia', $dependencia->nombre_dependencia, array('placeholder' => 'Nombre Dependencia', 'class' => 'form-control')) }}
	
		{{ Form::label('nombre_director', 'Director',array('class'=>'control-label')) }}
		{{ Form::text('nombre_director', $dependencia->nombre_directorl, array('placeholder' => 'Nombre Director', 'class' => 'form-control')) }}
	
		{{ Form::label('primer_apellido', 'Primer Apellido',array('class'=>'control-label')) }}
		{{ Form::text('primer_apellido', $dependencia->primer_apellido, array('placeholder' => 'Primer Apellido', 'class' => 'form-control')) }}
	
		{{ Form::label('segundo_apellido', 'Segundo Apellido',array('class'=>'control-label')) }}
		{{ Form::text('segundo_apellido', $dependencia->segundo_apellido, array('placeholder' => 'Segundo Apellido', 'class' => 'form-control')) }}
	
		<br>

		<center> {{ Form::button('Guardar Cambios', array('type' => 'submit', 'class' => 'btn btn-success')) }}</center>
        
   		

	{{ Form::close() }}



@stop
