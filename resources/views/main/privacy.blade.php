@extends('layouts.main')

@section('content')
    <div class="mt-3">
        @if(app()->getLocale() == 'de')
            @include('main.privacy.de')
        @else
            @include('main.privacy.en')
        @endif
    </div>
@endsection
