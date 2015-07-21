@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Admin</li>
</ol>

@stop

<h3><span class="label label-info">Listados nominales</span></h3><br>

	{{ Form::open(array ('url'=>'upload/', 'method' => 'post','enctype'=>'multipart/form-data')) }}

		{{ Form::label('id_rol', 'Selecciona un archivo para subir',array('class' => 'col-sm-2 control-label'))}}
	
		{{ Form::file('archivo', array('class' => 'btn btn-success btn-sm')) }}

	{{ Form::submit('subir',array('class' => 'btn btn-primary btn-sm')) }}
	
	{{ Form::close()}}

	<br>

	{{ Form::open(array ('url'=>'sincroniza/', 'method' => 'post','enctype'=>'multipart/form-data')) }}
		<div class="form-group">
	    	{{ Form::label('subir', 'Selecciona un archivo para sincronizar',array('class' => 'col-sm-2 control-label'))}}
	    <div class="col-sm-2">
	     	{{ Form::select('subir', $lista, null,array('class' => 'form-control')) }}
	    </div>
	    	{{ Form::submit('Sincronizar', array('class' => 'btn btn-warning btn-sm')) }}
	    </div>
    {{ Form::close()}}

	
    


@stop
