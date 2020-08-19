@extends('layouts.auth')

@section('content')
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <img class="mb-4 bd-placeholder-img" src="{{ asset("/images/jku.png") }}" alt="" width="200px" height="200px">
        <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name', 'Laravel') }}</h1>
        @if ( session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <label for="studentId" class="sr-only">Student ID</label>
        <input id="studentId" type="text" class="form-control @error('studentId') is-invalid @enderror" name="studentId"
               value="{{ old('studentId') }}" placeholder="Student ID" autocomplete="studentId"
               autofocus>
        @error('studentId')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label for="password" class="sr-only">Passwort</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" placeholder="Passwort" autocomplete="current-password">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
    </form>
@endsection
