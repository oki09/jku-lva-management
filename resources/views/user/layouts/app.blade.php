<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script data-ad-client="ca-pub-7068331585141884" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177012319-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-177012319-2');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- favicon --}}
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/roundedToggleSwitch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/calendar/main.min.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/6eb7acd8bf.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/calendar/main.min.js') }}"></script>
    <script src="{{ asset('js/calendar/locale/de.js') }}"></script>
    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
</head>

<body>
<div id="loader" class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" width="100%"
                                                              style="max-width: 3.5em"></a>
        <small class="text-white mr-2">{{env('TERM')}} | ECTS: {{session('totalEcts')}}</small>
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
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                        Logout <i class="fas fa-sign-out-alt"></i>
                    </button>
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
<script>
    $.blockUI.defaults.css = {};
    //$.blockUI.defaults = {message: $('#loader')};
    $(document).ajaxStart(function () {
        $.blockUI({
            message: $('#loader'),
            css: {
                padding: 0,
                margin: 0,
                width: '30%',
                top: '40%',
                left: '35%',
                textAlign: 'center',
                color: '#000',
                border: 'none',
                cursor: 'wait'
            }
        });
    });
    $(document).ajaxStop($.unblockUI);
</script>
</body>

</html>
