<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/6eb7acd8bf.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            Admin-Dashboard
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="{{ route('admin.settings') }}">Settings</a>
            </li>
            <li>
                <a href="{{ route('admin.index') }}">Users</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="ml-auto nav navbar-nav">
                    <form class="form-inline my-2 my-lg-0" method="POST" action="{{route('admin.logout')}}">
                        @csrf
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#lvaSection').on('click', function () {
            console.log('clicked');
        });
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>
</body>

</html>
