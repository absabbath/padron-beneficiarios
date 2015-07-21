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

{{ Form::open(array('action' => 'DependenciaController@store', 'method' => 'POST'), array('role' => 'form','class'=>'form-horizontal row-fluid')) }}
              

		{{ Form::label('nombre_dependencia', 'Dependencia',array('class'=>'control-label')) }}
		{{ Form::text('nombre_dependencia', null, array('placeholder' => 'Nombre Dependencia', 'class' => 'form-control')) }}
	
		{{ Form::label('nombre_director', 'Director',array('class'=>'control-label')) }}
		{{ Form::text('nombre_director', null, array('placeholder' => 'Nombre Director', 'class' => 'form-control')) }}
	
		{{ Form::label('primer_apellido', 'Primer Apellido',array('class'=>'control-label')) }}
		{{ Form::text('primer_apellido', null, array('placeholder' => 'Primer Apellido', 'class' => 'form-control')) }}
	
		{{ Form::label('segundo_apellido', 'Segundo Apellido',array('class'=>'control-label')) }}
		{{ Form::text('segundo_apellido', null, array('placeholder' => 'Segundo Apellido', 'class' => 'form-control')) }}
	
		<br>


         {{ Form::button('Registrar Dependencia', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

   		

	{{ Form::close() }}


@stop
