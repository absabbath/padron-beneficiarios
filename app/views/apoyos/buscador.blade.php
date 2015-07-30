@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

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

<h3>Buscar por nombre y apellido</h3>

@stop
