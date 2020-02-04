<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    :root { 
        --mainColor : @auth {{ Auth: :user()->settings->last()->mainColor ?? '#212529' }} @else '#123b64' @endauth;
    }
    </style>

    <link href="{{ asset('css/reboot.css') }}" rel="stylesheet">
    @yield('css')
    @laravelPWA
</head>

<body style="background: @auth url('backgrounds/{{ Auth::user()->settings->last()->backgroundImage ?? 'dark_gray.png' }}') @else url(backgrounds/dark_gray.png) @endauth no-repeat center fixed; background-size: cover;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-rb fixed-top">
            <div class="container">
                <a class="navbar-brand" id="appname" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button name="navbar-toggler" aria-label="Ouvrir_Le_Menu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
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