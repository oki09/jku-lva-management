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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="{{ asset('css/calendar/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/roundedToggleSwitch.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/calendar/main.min.js') }}"></script>
    <script src="{{ asset('js/calendar/locale/de.js') }}"></script>

    <script>
        const base_url = "{{url('/')}}";
    </script>
</head>

<body>
<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <img class="mb-4" src="{{ asset("/images/jku.png") }}" alt="" width="100px" height="100px"><br>
            Gesamt-ECTS: {{session('totalEcts')}}
        </div>

        <ul class="list-unstyled components">
            <p>{{__('Menü')}}</p>
            <li>
                <a href="{{ route('calendar.index') }}">{{ __('Kalender') }}</a>
            </li>
            <li>
                <a id="lvaSection" aria-expanded="false">{{ __('LVA-Verwaltung') }}</a>
                <ul class="list-unstyled" id="lvaManagement">
                    <li>
                        <a href="{{ route('lva.index') }}">{{ __('Meine LVAs') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('lva.create') }}">{{ __('LVA hinzufügen') }}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a id="infoSection" aria-expanded="false">{{ __('Info') }}</a>
                <ul class="list-unstyled" id="infoItems">
                    <li>
                        <a href="{{route('info.contact')}}">{{ __('Kontakt') }}</a>
                    </li>
                    <li>
                        <a href="{{route('info.privacy')}}">{{ __('Datenschutzerklärung') }}</a>
                    </li>
                </ul>
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
                    <li class="nav-item">
                        <a href="{{route('logout')}}">Logout</a>
                    </li>
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
