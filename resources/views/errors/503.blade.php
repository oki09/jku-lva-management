<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- favicon --}}
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/maintenance.css') }}" rel="stylesheet">
</head>
<body>
<article>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can
            always <a href="mailto:{{env('MAIL_TO_ADDRESS')}}">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
        <p>&mdash; The okihub developers</p>
    </div>
</article>
</body>

