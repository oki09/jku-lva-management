<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- favicon --}}
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/roundedToggleSwitch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/calendar/main.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/calendar/main.min.js') }}"></script>
    <script src="{{ asset('js/calendar/locale/de.js') }}"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo_white.png')}}" width="60px"
                                                              class="mr-3"><small>ECTS: {{session('totalEcts')}}</small>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('calendar.index')}}">
                        <i class="fa fa-calendar"></i>
                        {{__('Calendar')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-book">
                        </i>
                        {{__('Course-Management')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('lva.index')}}">{{__('My courses')}}</a>
                        <a class="dropdown-item" href="{{route('lva.create')}}">{{__('Add course')}}</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav">
                <form class="form-inline my-2 my-lg-0" method="POST" action="{{route('logout.user')}}">
                    @csrf
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </ul>
        </div>
    </div>
</nav>
<main role="main" class="container my-2 content">
    @yield('content')
</main>
<footer class="py-2 bg-dark">
    <div class="container text-white text-center">
        <p class="footerLinks m-0">
            <a href="https://github.com/oki09/jku-lva-management" target="_blank">GitHub</a> |
            <a href="{{route('info.contact')}}">{{__('Contact')}}</a> |
            <a href="{{route('info.privacy')}}">{{__('Privacy')}}</a> |
            Copyright &copy; Oktay Akgül 2020
        </p>
    </div>
</footer>
<div id="loader" class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
</div>
<script>
    $(document).ajaxStart(function () {
        $('#loader').show();
    });
    $(document).ajaxStop(function () {
        $('#loader').hide();
    });
</script>
</body>

</html>
