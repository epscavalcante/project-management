
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield("title") {{ config('app.name') }}</title>

        <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
        {{-- <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet"> --}}
        {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" /> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>
        
        <header>

            <nav class="navbar navbar-dark bg-dark px-0">
               <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <svg class="mr-2" width="36" height="36" viewbox="0 0 612 612" xmlns="http://www.w3.org/2000/svg" focusable="false">
                            <title>Bootstrap</title>
                            <path fill="currentColor" d="M510 8a94.3 94.3 0 0 1 94 94v408a94.3 94.3 0 0 1-94 94H102a94.3 94.3 0 0 1-94-94V102a94.3 94.3 0 0 1 94-94h408m0-8H102C45.9 0 0 45.9 0 102v408c0 56.1 45.9 102 102 102h408c56.1 0 102-45.9 102-102V102C612 45.9 566.1 0 510 0z"/>
                            <path fill="currentColor" d="M196.77 471.5V154.43h124.15c54.27 0 91 31.64 91 79.1 0 33-24.17 63.72-54.71 69.21v1.76c43.07 5.49 70.75 35.82 70.75 78 0 55.81-40 89-107.45 89zm39.55-180.4h63.28c46.8 0 72.29-18.68 72.29-53 0-31.42-21.53-48.78-60-48.78h-75.57zm78.22 145.46c47.68 0 72.73-19.34 72.73-56s-25.93-55.37-76.46-55.37h-74.49v111.4z"/>
                        </svg>
                        SETEC - Projetos
                    </a>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('projects.create') }}" class="btn btn-sm btn-success mr-2">Novo projeto</a>


                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i></button>
                        </form>
                    </div>
               </div>
            </nav>
            
            @if(count(Request::segments()))
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <?php $segments = ''; ?>
                    @for($segment = 1; $segment <= count(Request::segments()); $segment++)
                    <li  class="breadcrumb-item text-capitalize">
                        @if($segment < count(Request::segments()) && $segment > 0)
                        <?php $segments .= '/'.Request::segment($segment); ?>
                        <a href="{{ $segments }}">{{ str_replace('-', ' ', Request::segment($segment)) }}</a> 
                        @else
                        {{ str_replace('-', ' ', Request::segment($segment)) }}
                        @endif
                    </li>
                    @endfor
                </ol>
            </div>
            @endif
        </header>
            
        <main class="container-fluid">
            @yield('content')   
        </main>
        
        <script src="{{ asset('js/app.js') }}"> </script>
        <script src="{{ asset('js/sweetalert.min.js') }}"> </script>
        @include('sweetalert::alert')
        <script src="{{ asset('js/script.js') }}"></script>
    </body>

</html>
