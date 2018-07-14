<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Projetos - {{ config('app.name') }}</title>

        <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>
        <div class="main-container fullscreen">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-7">
                        <div class="text-center">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>