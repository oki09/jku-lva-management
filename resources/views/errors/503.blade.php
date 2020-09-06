<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script data-ad-client="ca-pub-7068331585141884" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    {{-- favicon --}}
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('favicon.png')}}">

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

