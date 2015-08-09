@extends('admin-layout')
<?php 
$instancia = new Apoyo();
 ?>

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li class="active">Resultados</li>
</ol>

@stop

<span class="label label-primary">
    <small>
        Mis beneficiarios
    </small>
</span>
<small>
    <a href="{{url('exporta/beneficiarios')}}">Exportar <i class="fa fa-download"></i></a>
</small>

<table class="table table-reponsive">
  <tr>
    <th>Clave electoral</th>
    <th>Nombre beneficiario</th>
    <th>Edad</th>
    <th>Domicilio</th>
    <th>Fecha otorgada</th>
    <th>Descripcion del apoyo</th>
    <th>Monto</th>
  </tr>
@foreach ($apoyos as $apoyo) 
  
  <tr>
    <td>
    {{ link_to_action('BeneficiarioController@buscarBeneficiario', $apoyo->beneficiario()->first()->clave_electoral, $parameters = array($apoyo->beneficiario()->first()->clave_electoral), array('class' => 'fa fa-info-circle ' )) }}
    </td>
    <td>
    {{$apoyo->beneficiario()->first()->nombre_beneficiario}} 
    {{$apoyo->beneficiario()->first()->primer_apellido_beneficiario}} 
    {{$apoyo->beneficiario()->first()->segundo_apellido_beneficiario}} 
    </td>
    <td>{{$apoyo->beneficiario()->first()->edad}}</td>
    <td>
    {{$apoyo->beneficiario()->first()->calle}} 
    {{$apoyo->beneficiario()->first()->num_ext}} 
    {{$apoyo->beneficiario()->first()->colonia}}
    </td>
    <td>{{$apoyo->fecha}}</td>
    <td>{{$apoyo->concepto}}</td>
    <td>${{$apoyo->monto}}</td>
  </tr>

@endforeach

</table>
{{ $apoyos->links() }}

@stop


