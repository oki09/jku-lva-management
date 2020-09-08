<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/x-icon" sizes="32x32"/>
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/x-icon" sizes="96x96"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/logo.png')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link href="{{ asset('css/admin/datatables.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/6eb7acd8bf.js" crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <div class="navbar-brand col-sm-3 col-md-3 mr-0">
        <img class="mb-2 mt-2 ml-2 mr-4" src="{{ asset("images/logo.png") }}" alt="" style="height:60px;">
        <span>{{ config('app.name', 'Laravel') }}</span>
    </div>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{route('admin.logout')}}">
                @csrf
                <button class="btn btn-primary text-white my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="navbar navbar-collapse">
            <ul class="navbar-nav">
                <li>
                    <a class="nav-link" href="{{route('admin.index')}}">
                        <i class="site-menu-icon fas fa-users"></i>
                        <span class="site-menu-title">User</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('admin.settings')}}">
                        <i class="fas fa-cog"></i>
                        <span class="site-menu-title">Settings</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('admin.news.index')}}">
                        <i class="fas fa-newspaper"></i>
                        <span class="site-menu-title">News</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('admin.faq.index')}}">
                        <i class="fas fa-question"></i>
                        <span class="site-menu-title">FAQ</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 my-2">
        @yield("content")
    </main>
</div>

</body>
</html>
