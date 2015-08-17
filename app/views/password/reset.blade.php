@extends('login-layout')

@section('panel-title')
Restablecer password
@stop

@section('panel-body')
{{ Form::open(array('url'=>URL::action('RemindersController@postReset'), 'class'=>'form-signin', 'role'=>'form')) }}
    <fieldset>
        <div class="form-group">
            {{ Form::text('usuario', null, array('class'=>'form-control', 'placeholder'=>'Usuario')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
        </div>
        <div class="form-group">
            {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Password')) }}
        </div>
        {{ Form::hidden('token', $token) }}
        {{ Form::submit('Restablecer password', array('class'=>'btn btn-lg btn-danger btn-block'))}}
    </fieldset>
{{ Form::close() }}

<footer>
    <div class="row">
        <div class="col-lg-12">
            <p class="text-center">¿Tienes una cuenta? <a href="{{ URL::to('login') }}">Inicia sesión</a>?</p>
        </div>
    </div>
</footer>

@stop
