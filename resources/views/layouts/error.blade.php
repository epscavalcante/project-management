
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Projetos - {{ config('app.name') }}</title>

        <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>

       @yield('content') 
        
    </body>

</html>
