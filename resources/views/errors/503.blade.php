<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/x-icon" sizes="32x32"/>
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/x-icon" sizes="96x96"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/logo.png')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/maintenance.css') }}" rel="stylesheet">
</head>
<body>
<article>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can
            always <a href="mailto:{{env('MAIL_TO_ADDRESS')}}">contact us</a>, otherwise we&rsquo;ll be back online
            shortly!</p>
        <p>&mdash; The okihub developers</p>
    </div>
</article>
</body>

