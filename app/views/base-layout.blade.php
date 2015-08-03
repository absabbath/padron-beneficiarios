<!doctype html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>
            @yield('title', getenv('APP_NAME'))
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- Place favicon's in the root directory -->
        <link rel="shortcut icon" type="image/png" href="/favicon.png">

        <!-- styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        @yield('styles', '')
        {{ HTML::style('assets/css/bootstrap.css'); }}
        {{ HTML::style('assets/css/app.css'); }}

    </head>

    <body class="home">

        @yield('header', '')

        @yield('content', '')

        @yield('footer', '')

        <!-- scripts -->
        {{ HTML::script('assets/js/jQuery-2.1.4.min.js'); }}
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        @yield('scripts', '')
        

    </body>
</html>
