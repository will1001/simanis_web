<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="myApp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet">

    <style>
        .select2-dynamic {
            width: 100% !important;
        }

        .select2 {
            width: 100% !important;
        }
    </style>

    @yield('style')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SIMANIS
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::check())
                        @if(Auth::user()->tipe_user == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.badan-usaha.index') }}">Badan Usaha</a>
                        </li>
                        @else
                        @if(Auth::user()->badan_usaha)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('badan-usaha.edit', ['badan_usaha' => Auth::user()->badan_usaha->id]) }}">Pendaftaran Badan
                                Usaha</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produk.index') }}">Pendaftaran Produk</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('badan-usaha.create') }}">Pendaftaran Badan
                                Usaha</a>
                        </li>
                        @endif
                        @endif
                        @endif
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Data Master
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('kelurahan-desa.index') }}">Kelurahan/Desa</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
                </li> --}}
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nama }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
    </div>
    </nav>

    <main class="py-4">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->pull('success') }}
        </div>
        @endif
        @if (session('failed'))
        <div class="alert alert-danger" role="alert">
            {{ session()->pull('failed') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="{{ asset('select2/js/select2.min.js') }}" type="text/javascript"></script>
    <!-- angularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.7/angular.min.js"></script>
    <script src="{{ asset('angularjs/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('angularjs/controllers.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $(".select2-dynamic").select2({
                tags: true
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
