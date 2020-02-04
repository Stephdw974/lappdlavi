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
        --mainColor : @auth {{ Auth::user()->settings->last()->mainColor ?? '#212529' }} @else '#123b64' @endauth;
    }
    </style>

    <link href="{{ asset('css/reboot.css') }}" rel="stylesheet">
    @yield('css')
    @laravelPWA
</head>

<body style="background: @auth url('backgrounds/{{ Auth::user()->settings->last()->backgroundImage ?? 'dark_gray.png' }}') @else url(backgrounds/dark_gray.png) @endauth no-repeat center fixed; background-size: cover;">
    <div id="app">
        <nav class="navbar navbar-dark bg-rb fixed-top">
            <span class="navbar-brand" id="appname" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</span>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/lappdlavi.js') }}"></script>
    @yield('js')
</body>

</html>