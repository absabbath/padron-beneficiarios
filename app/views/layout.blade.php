@extends('base-layout')

@section('header')
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">
                <span class="sr-only">Cambiar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ getenv('APP_NAME') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
                <li><a href="{{ URL::action('LoginController@anyLogout') }}"><span class="glyphicon glyphicon-off"></span> Cerrar sesión</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

<div class="mensajes container">

    @if(Session::has('message_success'))
    <div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message_success') }}</div>
    @endif

    @if(Session::has('message_info'))
    <div class="alert alert-dismissable alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message_info') }}</div>
    @endif

    @if(Session::has('message_warning'))
    <div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message_warning') }}</div>
    @endif

    @if(Session::has('message_danger'))
    <div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message_danger') }}</div>
    @endif

</div>
@stop

@section('footer')
<footer class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="well well-sm">Pie del sitio</p>
        </div>
    </div>
</footer>
@stop
