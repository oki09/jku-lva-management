@extends('layouts.main')

@section('content')
    <form class="form-signin d-flex flex-column justify-content-center align-items-center py-3" method="POST" action="{{ route('login.admin') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Admin Dashboard</h1>
        @if ( session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="col-md-5">
            <label for="adminId" class="sr-only">Admin ID</label>
            <input id="adminId" type="text" class="form-control @error('adminId') is-invalid @enderror" name="adminId"
                   value="{{ old('adminId') }}" placeholder="Admin ID" autocomplete="adminId"
                   autofocus>
            @error('adminId')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <label for="password" class="sr-only">Passwort</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" placeholder="Passwort" autocomplete="current-password">
            @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror

            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
        </div>
    </form>
@endsection
