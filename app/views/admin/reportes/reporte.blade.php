@extends('admin-layout')

@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Home</li>
</ol>

@stop

<table class="table table-striped">
	<tr>
		<th>Dependecia</th>
		<th>Apoyos otorgados</th>
	</tr>

	@foreach($reporte as $rep)
		<tr>
			<td>{{$rep['Dependencia']}}</td>
			<td> <span class="badge"> {{$rep['Contador']}} </span></td>
		</tr>
	@endforeach

	<tr>
		<th>Numero total de apoyos otorgados</th>
		<td> <h4><span class="label label-warning"> {{Apoyo::count()}} </span></h4></td>
	</tr>

</table>

@stop
