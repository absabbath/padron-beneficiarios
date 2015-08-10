@extends('login-layout')

@section('panel-title')
Bienvenido
@stop

@section('panel-body')
{{ Form::open(array('url'=>URL::to('login'), 'class'=>'form-signin', 'role'=>'form')) }}
    <fieldset>
        <div class="form-group">
            {{ Form::text('usuario', null, array('class'=>'form-control', 'placeholder'=>'Usuario')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label for="remember">
                    {{ Form::checkbox('remember', '0', false, array()) }} Permanecer conectado
                </label>
            </div>
        </div>
        {{ Form::submit('Ingresar', array('class'=>'btn btn-lg btn-danger btn-block')) }}
    </fieldset>
{{ Form::close() }}
@stop

@section('footer')
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">¿Olvidaste tus <a href="{{ URL::to('password/remind') }}">credenciales de acceso</a>?</p>
        </div>
    </div>
</footer>
@stop
