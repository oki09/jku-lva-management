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

    <meta name="description"
          content="The course management system for students of JKU Linz. Educate yourself smarter and save precious time.">
    <meta name="keywords" content="jku, management, student, study, education, smart, edusmart">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- favicon --}}
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/6eb7acd8bf.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css"/>
    <script src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js" defer></script>
    <script>
        window.addEventListener("load", function () {
            window.wpcc.init({
                "border": "thin",
                "corners": "small",
                "colors": {
                    "popup": {"background": "#f6f6f6", "text": "#000000", "border": "#555555"},
                    "button": {"background": "#555555", "text": "#ffffff"}
                },
                "position": "bottom",
                "content": {"href": "https://okihub.io/privacy"}
            })
        });
    </script>
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" width="100%"
                                                              style="max-width: 3.5em"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i>
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('calendar.index')}}"><i class="fas fa-columns"></i>
                        {{__('My Dashboard')}}
                    </a>
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
            <a href="https://github.com/oki09/jku-lva-management" target="_blank">GitHub</a> |
            <a href="{{route('info.contact')}}">{{__('Contact')}}</a> |
            <a href="{{route('info.privacy')}}">{{__('Privacy')}}</a> |
            Copyright &copy; okihub 2020
        </p>
    </div>
</footer>
</body>

</html>
