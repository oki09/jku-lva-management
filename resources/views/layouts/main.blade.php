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
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo_white.png')}}" width="70px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">{{__('Home')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('calendar.index')}}">
                        {{__('Zum Dashboard')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.index')}}">{{__('Admin Dashboard')}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container content">
    @yield('content')
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
