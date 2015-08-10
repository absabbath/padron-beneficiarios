@extends('admin-layout')
<?php

    if ($beneficiario->exists):
        $form_data = array('route' => array('nuevo.beneficiario.update', $beneficiario->id), 'method' => 'PUT');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'beneficiario.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>
@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li class="active"><i class="fa fa-user"></i> {{$action}} Beneficiario</li>
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


  <center>
    <h3>
      <span class="label label-primary">
        {{$action}} beneficiario {{$beneficiario->id}}
      </span>
    </h3>
  </center>

{{Form::model($beneficiario, $form_data, array('role' => 'form', 'class'=>'form-horizontal row-fluid'))}}
<div class="col-md-4">
    {{ Form::label('clave_electoral', 'Clave de elector',array('class'=>'control-label')) }}
    {{ Form::text('clave_electoral', null, array('placeholder' => 'Clave de elector', 'class' => 'form-control')) }}

    {{ Form::label('nombre_beneficiario', 'Nombre',array('class'=>'control-label')) }}
    {{ Form::text('nombre_beneficiario', null, array('placeholder' => 'Nombre(s)', 'class' => 'form-control')) }}

    {{ Form::label('primer_apellido_beneficiario', 'Primer apellido',array('class'=>'control-label')) }}
    {{ Form::text('primer_apellido_beneficiario', null, array('placeholder' => 'Primer apellido', 'class' => 'form-control')) }}

    {{ Form::label('segundo_apellido_beneficiario', 'Segundo apellido',array('class'=>'control-label')) }}

    {{ Form::text('segundo_apellido_beneficiario', null, array('placeholder' => 'Segundo apellido', 'class' => 'form-control')) }}
    
    {{ Form::label('validar', '*CURP OBLIGATORIA PARA VALIDAR EXISTENCIA',array('class'=>'control-label')) }}

    <!--input type="text" name ="curp" id="curp" placeholder="Ingrese la curp" class="form-control" required/ -->


  </div>

  <div class="col-md-4">
      {{ Form::label('secc_electoral', 'Seccion electoral',array('class'=>'control-label')) }}
      {{ Form::number('secc_electoral', null, array('placeholder' => 'Seccion electoral', 'class' => 'form-control')) }}


      {{ Form::label('sexo', 'Sexo',array('class'=>'control-label')) }}
      {{ Form::select('sexo', ['H' => 'Hombre', 'M' => 'Mujer'], null, ['class' => 'form-control', 'id' => 'programa']) }}

      {{ Form::label('edad', 'Edad',array('class'=>'control-label')) }}
      {{ Form::number('edad', null, array('placeholder' => 'Edad', 'class' => 'form-control')) }}

      {{ Form::label('ocupacion', 'Ocupación',array('class'=>'control-label')) }}
      {{ Form::text('ocupacion', null, array('placeholder' => 'Ocupacion', 'class' => 'form-control')) }} 
      <br>
    <center>{{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }} <br></center>>
  </div>

  <div class="col-md-4">
    {{ Form::label('calle', 'Calle',array('class'=>'control-label')) }}
    {{ Form::text('calle', null, array('placeholder' => 'Calle', 'class' => 'form-control')) }}

  
    {{ Form::label('num_ext', 'Numero exterior',array('class'=>'control-label')) }}
    {{ Form::text('num_ext', null, array('placeholder' => 'Numero exterior', 'class' => 'form-control')) }}

    {{ Form::label('num_int', 'Numero interior',array('class'=>'control-label')) }}
    {{ Form::text('num_int', null, array('placeholder' => 'Numero interior (Opcional)', 'class' => 'form-control')) }}

    {{ Form::label('colonia', 'Colonia',array('class'=>'control-label')) }}
    {{ Form::text('colonia', null, array('placeholder' => 'Colonia', 'class' => 'form-control')) }}


    {{ Form::label('cp', 'Codigo postal',array('class'=>'control-label')) }}
    {{ Form::text('cp', null, array('placeholder' => 'Codigo postal', 'class' => 'form-control')) }}

</div>
 
    

{{Form::close()}}




@stop

@section('scripts', '')

  <script type="text/javascript">
//Para usar la validacio de curp solo 
//, 'onclick' => 'validar()' despues de clase,
//descomentar el input de la curp
//y cmbiar el tipo a submit
  function validar () {

    var RegExPattern = "[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}" +
    "(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])" +
    "[HM]{1}" +
    "(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)" +
    "[B-DF-HJ-NP-TV-Z]{3}" +
    "[0-9A-Z]{1}[0-9]{1}$";

    var campo = document.getElementById('curp').value.toUpperCase();
    

    if ((campo.match(RegExPattern))) {

        document.getElementById("formx").submit();

    } else {
        alert('La CURP ingresada no es valida!');
        
    } 
  }
  </script>
@stop