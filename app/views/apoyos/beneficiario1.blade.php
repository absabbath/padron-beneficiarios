@extends('admin-layout')

<?php 
$apoyoInstancia = new Apoyo();
//Para saber los programas que debe mostrar de acuerdo a la dependencia logueada
if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('root')) {

  $idDependencia = 0;

} else {

$idDependencia = Auth::user()->dependencia()->get()->first()->id;

}

?>


@section('content')

@section('ruta')

 <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="{{url('buscador')}}"><i class="fa fa-search"></i> Buscar</a></li>
    <li class="active"><i class="fa fa-user"></i> Beneficiario</li>
</ol>

@stop

<div class="row">
<!-- Modulo donde se muestran los datos del beneficiario y  se agregan los faltantes-->
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
      <small> <a href="{{ route('beneficiario.editar', $persona->id) }}" data-toggle="tooltip" data-placement="right" title="Editar información"> {{$persona->clave_electoral}} <i class="fa fa-edit"></i></a></small>
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
        {{ Form::textarea('comentario', $persona->comentario, array('placeholder' => 'Comentarios', 'class' => 'form-control')) }} <br>
      
        {{ Form::button('Actualizar datos', array('type' => 'submit', 'class' => 'btn btn-primary')) }}

    {{ Form::close() }}    
  </div><!-- /.box-body -->
</div><!-- /.box -->

</div><!-- /.box.primary -->


</div><!-- /.col -->


<!-- Modulo donde se muestran los aopyos del beneficiario y botn para agregar otro -->

<div class="col-md-6">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Apoyos</h3>
    <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
    Nuevo
  </button>

  <table class="table table-responsive table-condensed">
      <tr>
        <th>Tipo apoyo</th>
        <th>Monto</th>
        <th>Fecha</th>
        <th>Periodicidad</th>
        <th>Otorgado por <br> (Dependencia)</th>
      </tr>
      @foreach($apoyos as $apoyo)
          <tr>
            <td><a href="#" id="<?php echo $apoyo->id?>" class="push" data-toggle="modal" data-target="#myModal2">{{$apoyoInstancia->buscarTipo($apoyo->id_tipo_apoyos)}}</a></td>
            <td>${{$apoyo->monto}}</td>
            <td>{{$apoyo->fecha}}</td>
            <td>{{$apoyo->periodicidad}}</td>
            <td>{{$apoyoInstancia->getDependencia($apoyo->id_subprogramas)}}</td>
          </tr>  
      @endforeach
  </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
</div>

</div><!-- /.row -->

<!-- Modal donde se muestra el formulario para asignar nuevo apoyo -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Asignar apoyo</h4>
      </div>
      <div class="modal-body">

        {{ Form::open(array('action' => 'BeneficiarioController@asignarApoyo', 'method' => 'POST'), array('role' => 'form','class'=>'form-horizontal row-fluid')) }}

          {{Form::hidden('id_beneficiario',$persona->id)}}
          
           
          {{ Form::label('programas', 'Programas de esta dependencia',array('class'=>'control-label')) }}
          {{ Form::select('programa', $apoyoInstancia->getProgramas($idDependencia), null, ['class' => 'form-control', 'id' => 'programa']) }}

          {{ Form::label('subprogramas', 'Subprograma',array('class'=>'control-label')) }}
          {{ Form::select('subprogramas', ['0'=>'Selecciona un programa primero'], null, ['class' => 'form-control','id' => 'subprograma']) }}

          {{ Form::label('tipo', 'Tipo de apoyo',array('class'=>'control-label')) }}
          {{ Form::select('tipo', $apoyoInstancia->getTipo(), null, ['class' => 'form-control']) }}

          {{ Form::label('fecha', 'Fecha',array('class'=>'control-label')) }}
          <input type="date" name="inicio" class="form-control" id="inicio" required max="<?php echo date('Y-m-d');?>" placeholder="YYYY/MM/DD">

          {{ Form::label('monto', 'Monto',array('class'=>'control-label')) }}
          {{ Form::text('monto', 0, array('placeholder' => 'Monto', 'class' => 'form-control')) }}
          
          {{ Form::label('periodicidad', 'Periodicidad',array('class'=>'control-label')) }}
          {{ Form::select('periodicidad', array('Un solo pago' => 'Un solo pago', 'Quincenal' => 'Quincenal', 'Anual' => 'Anual', 'Mensual' => 'Mensual', 'Bimestral' => 'Bimestral', 'Semestral' => 'Semestral', 'Otro' => 'Otro'), null, ['class' => 'form-control']) }}

          {{ Form::label('concepto', 'Descripcion del apoyo',array('class'=>'control-label')) }}
          {{ Form::textarea('concepto','Descripcion',array('class' => 'form-control', 'rows'=>'3')) }}

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
      {{Form::close()}}

      </div>
    </div>
  </div>
</div>

<!-- Modal donde se muestra la consulta del detalle de cada apoyo -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle...</h4>
      </div>

      <div class="modal-body">
          <div class="something">
               Cargando...
           </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


@stop

@section('scripts','')
 <script type="text/javascript">

  $(document).ready(function(){
    //Funcion para consultar selects dinamicos
    $('#programa').change(function(){
      $.get("{{ url('dropdown')}}",
      { programa: $(this).val() },
      function(data) {
        $('#subprograma').empty();
        $.each(data, function(key, element) {
          $('#subprograma').append("<option value='" + key + "'>" + element + "</option>");
        });
      });
    });

    //Funcion para consultar el detalle de un apoyo
    $('.push').click(function(){
      var essay_id = $(this).attr('id');
      $.get("{{ url('detalle')}}",
      { apoyo: essay_id },
      function(data) {
        $('.something').empty();
        var html="<div class = 'well'><h1>Detalle del apoyo</h1>";
        
        $.each(data, function(key, element) {
      
          html+=key+": ";
          html+="<b>"+element+"</b><br>";
             
        });
        html+="</div>";
        $('.something').append(html);
      });

    });

  });
 </script>
@stop