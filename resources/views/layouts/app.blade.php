<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="{{ asset('css/reboot.css') }}" rel="stylesheet">
    @yield('css')


    <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/apple-icon-180x180.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body @auth style="background: url('backgrounds/{{ Auth::user()->settings->last()->backgroundImage ?? 'dark_gray.png' }}') no-repeat center fixed; background-size: cover;" @endauth>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-rb fixed-top">
            <div class="container">
                <a class="navbar-brand" id="appname" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-3">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/lappdlavi.js') }}"></script>
    @yield('js')
</body>

</html>