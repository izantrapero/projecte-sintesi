<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Activitat_3_1 - @yield('title')</title>
        @section('stylesheets')
	    <link rel="stylesheet" href="{{ asset('css/taula.css') }}" />
        @show
    </head>
    <body>
        @include('navbar')

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>