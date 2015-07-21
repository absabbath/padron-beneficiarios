@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<div class="row">

<div class="col-md-6">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Datos de beneficiario</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="well">
    <h3>
      {{$persona->nombre_beneficiario }}
      {{$persona->primer_apellido_beneficiario }}
      {{$persona->segundo_apellido_beneficiario }}
    </h3>
    <br>
    <h4>
      Domicilio:
    </h4>
    <b>
      Calle: {{$persona->calle}}<br>
      Numero Exterior: {{$persona->num_ext }}, 
      Numero Interior: {{$persona->num_int }}<br>
      Colonia: {{$persona->colonia}}<br>
      Codigo Postal: {{$persona->cp}}
    </b>
    <br>
    <br>
    <h4>
      Datos de contacto:
    </h4>

    {{ Form::model($persona, array('route' => array('beneficiario.update', $persona->id), 'method' => 'PUT'), array('role' => 'form')) }}

        {{ Form::label('tel_casa', 'Telefono de casa',array('class'=>'control-label')) }}
        {{ Form::number('tel_casa', $persona->tel_casa, array('placeholder' => 'Telefono de casa', 'class' => 'form-control')) }}
      
        {{ Form::label('tel_cel', 'Telefono Celular',array('class'=>'control-label')) }}
        {{ Form::number('tel_cel', $persona->tel_cel, array('placeholder' => 'Telefono Celular', 'class' => 'form-control')) }}
      
        {{ Form::label('email', 'Correo electrónico',array('class'=>'control-label')) }}
        {{ Form::email('email', $persona->email, array('placeholder' => 'Correo electronico', 'class' => 'form-control')) }}
      
        {{ Form::label('comentario', 'Comentarios sobre persona',array('class'=>'control-label')) }}
        {{ Form::textarea('comentario', $persona->comentario, array('placeholder' => 'Comentarios', 'class' => 'form-control')) }}
      
        <br>


        {{ Form::button('Actualizar datos', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

          

    {{ Form::close() }}    
  </div><!-- /.box-body -->
</div><!-- /.box -->

</div><!-- /.box.primary -->


</div><!-- /.col -->


<div class="col-md-6">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Apoyos</h3>
    <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div><!-- /.row -->



@stop
