
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
        {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" /> --}}
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
        {{-- <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet" type="text/css" media="all" /> --}}
    </head>

    <body>

       <div class="layout layout-nav-top layout-sidebar">
            <div class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img alt="Pipeline" src="{{ asset('images/logo.svg') }}" />
                </a>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-block d-lg-none ml-2">
                        <div class="dropdown">
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img alt="Image" src="{{ asset(auth()->user()->image) }}" class="avatar" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Account Settings</a>
                                <a href="#" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse justify-content-between" id="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" id="nav-dropdown-2">Projetos</a>
                                <div class="dropdown-menu" aria-labelledby="nav-dropdown-2">
                                    <a class="dropdown-item" href="{{ route('projects') }}">Listar projetos</a>
                                    <a class="dropdown-item" href="{{-- {{ route('user.projects') }} --}}">Meus projetos</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="d-lg-flex align-items-center">
                        <form class="form-inline my-lg-0 my-2 mr-2">
                            <div class="input-group input-group-dark input-group-round">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">search</i>
                                    </span>
                                </div>
                                <input type="search" class="form-control form-control-dark" placeholder="Fazer uma busca" aria-label="Search app" aria-describedby="search-app">
                            </div>
                        </form>
                        {{-- <div class="dropdown mx-lg-2">
                            <button class="btn btn-success btn-block dropdown-toggle" type="button" id="newContentButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Novo
                            </button>
                            <div class="dropdown-menu" aria-labelledby="newContentButton">
                                <a class="dropdown-item" href="#">Team</a>
                                <a class="dropdown-item" href="#">Project</a>
                                <a class="dropdown-item" href="#">Task</a>
                            </div>
                        </div> --}}
                        <div class="d-none d-lg-block">
                            <div class="dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="Image" src="{{ asset(auth()->user()->image) }}" class="avatar" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="nav-side-user.html" class="dropdown-item">Profile</a>
                                    <a href="utility-account-settings.html" class="dropdown-item">Account Settings</a>
                                    <a href="#" class="dropdown-item">Log Out</a>
                                </div>
                            </div>
                        </div>
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
                                        <a href="{{ $segments }}">{{ Request::segment($segment) }}</a> 
                                        @else
                                        {{ Request::segment($segment)}}
                                        @endif
                                    </li>
                                    @endfor
                                </ol>
                            </nav>
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
