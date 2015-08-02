@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<div class="col-md-6 well">
<!-- search form (Optional) -->
<h3>Buscar por clave electoral</h3>
<form action="{{URL::action('BeneficiarioController@buscarBeneficiario', 'buscador')}}" method="PUT" class="sidebar-form">
  <div class="input-group">
    <input type="text" name="q" class="form-control" placeholder="Clave elector..."/>
      <span class="input-group-btn">
        <button type='submit' class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
  </div>
</form>
<!-- /.search form -->
</div>


<div class="col-md-6 well">
<h3>Buscar por nombre y apellido</h3>
{{ Form::open(array('action' => 'BeneficiarioController@buscaSimilares', 'method' => 'POST'), array('role' => 'form','class'=>'form-inline','id' => 'formulario')) }}

  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control sidebar-form" name="nombre" id="nombre" placeholder="Nombre" required>
  </div>
  <div class="form-group">
    <label for="primer_apellido">Primer Apellido</label>
    <input type="primer_apellido" class="form-control sidebar-form" name="primer_apellido" id="primer_apellido" placeholder="Primer Apellido" required>
  </div>
  <button type="submit" id="button" class="btn btn-default fa fa-search"> Buscar</button>

{{Form::close()}}

</div>


@stop
