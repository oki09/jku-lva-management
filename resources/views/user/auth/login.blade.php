@extends('layouts.auth')

@section('content')
    <form class="form-signin" method="POST" action="{{ route('login.user') }}">
        @csrf
        <img src="{{ asset("images/logo_black.png") }}" alt="" width="200px" height="200px">
        <h5 class="mb-3 font-weight-normal">
            {{__('Please use your KUSSS credentials')}}
            <span><a href="#" class="popup" data-toggle="tooltip"
                     title="{{__('The first time you log in, your credentials will be sent to the KUSSS system for verifying your identity. After this step your data is stored in our database in order to make the login process faster')}}">
                    ?
                </a>
            </span>
        </h5>
        @if ( session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <label for="studentId" class="sr-only">Student ID</label>
        <input id="studentId" type="text" class="form-control @error('studentId') is-invalid @enderror" name="studentId"
               value="{{ old('studentId') }}" placeholder="{{__('Student ID')}}" autocomplete="studentId"
               autofocus>
        @error('studentId')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label for="password" class="sr-only">Passwort</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" placeholder="{{__('Password')}}" autocomplete="current-password">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
    </form>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
