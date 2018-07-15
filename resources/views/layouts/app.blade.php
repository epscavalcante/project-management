
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Projetos - {{ config('app.name') }}</title>

        <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
        {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" /> --}}
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>

       <div class="layout layout-nav-top layout-sidebar">
            <div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img alt="WebDev Projetos" src="{{ asset('images/logo.svg') }}" />
                </a>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-block d-lg-none mx-2">
                        <a href="{{ route('profile') }}">
                            <img alt="Imagem de perfil" src="{{ asset(auth()->user()->image) }}" class="avatar" />
                        </a>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="d-block d-lg-none">
                        @csrf
                        <button class="btn btn-round" type="submit"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
                <div class="collapse navbar-collapse justify-content-between" id="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('trash') }}">LIXEIRA</a>
                        </li>
                    </ul>
                    <div class="d-lg-flex align-items-center">
                        <form class="form-inline my-lg-0 my-2 mr-2">
                            <div class="input-group input-group-dark input-group-round">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="search" class="form-control form-control-dark" placeholder="Fazer uma busca" aria-label="Search app" aria-describedby="search-app">
                            </div>
                        </form>
                        
                        <div class="d-none d-lg-block  mr-2">
                            <a href="{{ route('profile') }}" class="text-light">
                                <img alt="Image" src="{{ asset(auth()->user()->image) }}" class="avatar" />
                                {{ auth()->user()->name }}
                            </a>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="d-none d-lg-block">
                            @csrf
                            <button class="btn btn-round" type="submit"><i class="fas fa-sign-out-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="main-container">
                <div class="sidebar-container">
                    @yield('sidebar')
                </div>
                <div class="content-container">
                    @if(count(Request::segments()))
                        <div class="navbar bg-white breadcrumb-bar">
                            <nav aria-label="breadcrumb">
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
                            </nav>
                            @yield('config')
                        </div>
                        @endif
                    <div class="container">
                        @yield('content')   
                    </div>

                </div>
                
            </div>
        </div>  
        
        <script src="{{ asset('js/jquery.min.js') }}"> </script>
        <script src="{{ asset('js/bootstrap.min.js') }}"> </script>
        <script src="{{ asset('js/sweetalert.min.js') }}"> </script>
        @include('sweetalert::alert')
        <script src="{{ asset('js/script.js') }}"></script>
    </body>

</html>
