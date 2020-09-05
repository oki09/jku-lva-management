@extends('layouts.main')

@section('content')
    <form class="form-signin" method="POST" action="{{ route('login.user') }}">
        @csrf
        <img src="{{ asset("images/logo.png") }}" alt="okihub logo" width="100%" style="max-width: 10em">
        <h5 class="my-3 font-weight-normal">
            {{__('Please use your KUSSS credentials')}}
            <span>
                <a href="#" class="popup" data-toggle="tooltip" data-html="true"
                   title="{!! __('The first time you log in, your credentials will be sent to the KUSSS system for verifying your identity. After this step your data is stored in our database in order to make the login process faster') !!}">
                    <i class="far fa-question-circle"></i>
                </a>
            </span>
        </h5>
        @if ( session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <label for="studentId" class="sr-only">{{__('Student ID')}}</label>
        <input id="studentId" type="text" class="form-control @error('studentId') is-invalid @enderror" name="studentId"
               value="{{ old('studentId') }}" placeholder="{{__('Student ID')}}" autofocus>
        @error('studentId')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror

        <label for="password" class="sr-only">{{__('Password')}}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" placeholder="{{__('Password')}}" autocomplete="current-password">
        @error('password')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
