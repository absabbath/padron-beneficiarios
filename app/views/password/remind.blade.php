@extends('login-layout')

@section('panel-title')
Restablecer password
@stop

@section('panel-body')
{{ Form::open(array('url'=>URL::action('RemindersController@postRemind'), 'class'=>'form-signin', 'role'=>'form')) }}
    <fieldset>
        <div class="form-group">
            {{ Form::text('usuario', null, array('class'=>'form-control', 'placeholder'=>'Usuario')) }}
        </div>
        {{ Form::submit('Restablecer password', array('class'=>'btn btn-lg btn-info btn-block'))}}
    </fieldset>
{{ Form::close() }}
@stop

@section('footer')
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">¿Tienes una cuenta? <a href="{{ URL::to('login') }}">Inicia sesión</a>?</p>
        </div>
    </div>
</footer>
@stop
