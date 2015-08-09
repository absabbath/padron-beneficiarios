@extends('admin/reportes/filtros')
<?php 
$instancia = new Apoyo();
 ?>
@section('ruta')

 <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="{{url('admin')}}"><i class="fa fa-lock"></i> Admin</a></li>
    <li><a href="{{url('admin/reportes')}}"><i class="fa fa-search"></i> Reportes</a></li>
    <li class="active">Resultados</li>
</ol>

@stop

@section('reporte','')
<span class="label label-primary" ><small> {{$msj}} </small></span>

<table class="table table-reponsive">
  <tr>
    <th>Clave electoral</th>
    <th>Nombre beneficiario</th>
    <th>Edad</th>
    <th>Sexo</th>
    <th>Ocupacion</th>
    <th>Seccion electoral</th>
    <th>Domicilio</th>
    <th>Dependencia</th>
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
    <td>{{$apoyo->beneficiario()->first()->sexo}}</td>
    <td>{{$apoyo->beneficiario()->first()->ocupacion}}</td>
    <td>{{$apoyo->beneficiario()->first()->secc_electoral}}</td>
    <td>
    {{$apoyo->beneficiario()->first()->calle}} 
    {{$apoyo->beneficiario()->first()->num_ext}} 
    {{$apoyo->beneficiario()->first()->colonia}}
    </td>
    <td>{{$instancia->getDependencia($apoyo->id_subprogramas)}}</td>
    <td>{{$apoyo->fecha}}</td>
    <td>{{$apoyo->concepto}}</td>
    <td>${{$apoyo->monto}}</td>
  </tr>

@endforeach

</table>
{{ $apoyos->links() }}

@stop


