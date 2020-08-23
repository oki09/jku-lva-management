<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- favicon --}}
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo_white.png')}}" width="80px"></a>
    </div>
</nav>
<div class="container content">
    @yield("content")
</div>

<footer class="py-2 bg-dark">
    <div class="container text-white text-center">
        <p class="footerLinks m-0">
            <a href="{{route('info.contact')}}">Kontakt</a> |
            <a href="{{route('info.privacy')}}">Datenschutzerklärung</a> |
            Copyright &copy; Oktay Akgül 2020
        </p>
    </div>
</footer>
</body>

</html>
