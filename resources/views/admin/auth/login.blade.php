@extends('layouts.auth')

@section('content')
    <form class="form-signin" method="POST" action="{{ route('login.admin') }}">
        @csrf
        <img class="bd-placeholder-img" src="{{ asset("images/logo_black.png") }}" alt="" width="200px" height="200px">
        <h1 class="h3 mb-3 font-weight-normal">Admin Dashboard</h1>
        @if ( session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <label for="adminId" class="sr-only">Admin ID</label>
        <input id="adminId" type="text" class="form-control @error('adminId') is-invalid @enderror" name="adminId"
               value="{{ old('adminId') }}" placeholder="Admin ID" autocomplete="adminId"
               autofocus>
        @error('adminId')
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
