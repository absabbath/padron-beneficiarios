@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="{{url('admin')}}"><i class="fa fa-lock"></i> Admin</a></li>
    <li class="active">Reportes</li>
</ol>

@stop
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Filtros</h3>
    <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Expandir"><i class="fa fa-minus"></i></button>
    </div>
  </div>
<div class="box-body well">
<div class="col-md-4">
  <h4>Por seccion</h4>
  
  {{ Form::open(array('route' => array('admin.reporte.beneficiario', 'seccion'), 'method' => 'GET', 'class'=>'form-inline')) }}
    <div class="input-group">
      <input type="text" class="form-control" name="seccion" placeholder="Introduzca la seccion electoral">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
  {{Form::close()}}
  </div><!-- /.col-lg-6 -->

  <div class="col-md-4">
  <h4>Por dependencia</h4>
  {{ Form::open(array('route' => array('admin.reporte.beneficiario', 'dependencia'), 'method' => 'GET', 'class'=>'form-inline')) }}
    <div class="input-group">
      {{ Form::select('dependencia', $combo, null, ['class' => 'form-control']) }}
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  {{Form::close()}}
  <div class="col-md-4">
    <h4>Por fecha</h4>
    {{ Form::open(array('route' => array('admin.reporte.beneficiario', 'fecha'), 'method' => 'GET', 'class'=>'form-inline')) }}
    <form class="form-inline">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Desde:</div>
          <input type="date" class="form-control" id="exampleInputAmount" name="inicio" placeholder="AAAA/MM/DD">
        </div>

        <div class="input-group">
          <div class="input-group-addon">Hasta: </div>
          <input type="date" class="form-control" id="exampleInputAmount" name="fin" placeholder="AAAA/MM/DD">
           <span class="input-group-btn">
          <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    {{Form::close()}}
        </div>
       
      </div>
     
    </form>
  </div><!-- /.col-lg-6 --> 

</div>
</div>

  <div class="box">
    <div class="well">
      @yield('reporte', '<h4>Elija un filtro para consultar...</h4>')
      
    </div>
  </div>

@stop
