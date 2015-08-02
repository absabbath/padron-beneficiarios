@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Admin</li>
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
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Introduzca la seccion electoral">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->

  <div class="col-md-4">
  <h4>Por dependencia</h4>
    <div class="input-group">
      {{ Form::select('tipo', $combo, null, ['class' => 'form-control']) }}

      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->

  <div class="col-md-4">
    <h4>Por fecha</h4>
    <form class="form-inline">
      <div class="form-group">
        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
        <div class="input-group">
          <div class="input-group-addon">Desde:</div>
          <input type="date" class="form-control" id="exampleInputAmount" placeholder="Amount">
        </div>

        <div class="input-group">
          <div class="input-group-addon">Hasta: </div>
          <input type="date" class="form-control" id="exampleInputAmount" placeholder="Amount">
           <span class="input-group-btn">
          <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
        </span>
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
