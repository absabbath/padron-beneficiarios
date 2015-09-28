@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
     <li><a href="{{url('buscador')}}"><i class="fa fa-search"></i> Buscar</a></li>
    <li class="active"><i class="fa fa-result"></i> Resultados</li>
</ol>

@stop

@foreach ($personas as $persona)

<div class="col-md-4"> 
  <div class="panel panel-info">
    <div class="panel-heading">{{$persona->nombre_beneficiario. " ".$persona->primer_apellido_beneficiario." ".$persona->segundo_apellido_beneficiario}}</div>
      <div class="panel-body">
      <h4>Numero de apoyos: <span class="badge">{{$persona->apoyos->count()}}</span></h4>
        <h3>Domicilio</h3>
        <p> Clave electoral: <b>{{$persona->clave_electoral}} </b></p>
        <p> Calle: <b>{{$persona->calle}}</b> </p>
        <p> Numero: <b>{{$persona->num_ext}}</b> </p>
        <p> Colonia: <b>{{$persona->colonia}}</b> </p>          
      </div>
      <div class="panel-footer">
        {{ link_to_action('BeneficiarioController@buscarBeneficiario', ' Ir a detalle', $parameters = array($persona->clave_electoral), array('class' => 'btn btn-info btn-sm fa fa-info-circle' )) }}
      </div>
  </div>
</div>

@endforeach


@stop
