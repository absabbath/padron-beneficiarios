@extends('base-layout')

@section('header')
<div class="container login-header">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>{{ getenv('APP_NAME') }}</h1>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container login">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        @yield('panel-title', '')
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="mensajes">

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

                    @yield('panel-body', '')

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /container -->
@stop
