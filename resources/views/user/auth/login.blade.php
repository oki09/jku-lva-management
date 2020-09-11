@extends('layouts.main')

@section('content')
    <div id="loader" class="spinner-border text-primary" role="status" style="display: none">
        <span class="sr-only">Loading...</span>
    </div>
    <form id="loginForm" class="form-signin d-flex flex-column justify-content-center align-items-center py-3"
          method="POST"
          action="{{ route('login.user') }}">
        @csrf
        <img src="{{ asset("images/logo.png") }}" alt="EduSmart logo" width="100%" style="max-width: 10em">
        <h5 class="my-3 font-weight-normal">
            {{__('Please use your KUSSS credentials')}}
            <span>
                <a href="#" class="popup" data-toggle="tooltip" data-html="true"
                   title="{{ __('The KUSSS data is needed in order to verify the identity. For more information, please read the FAQs.') }}">
                    <i class="far fa-question-circle"></i>
                </a>
            </span>
        </h5>
        @if ( session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="col-md-5">
            <label for="studentId" class="sr-only">{{__('Student ID')}}</label>
            <input id="studentId" type="text" class="form-control @error('studentId') is-invalid @enderror"
                   name="studentId"
                   value="{{ old('studentId') }}" placeholder="{{__('Student ID')}}" autofocus required>
            @error('studentId')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <label for="password" class="sr-only">{{__('Password')}}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" placeholder="{{__('Password')}}" autocomplete="current-password" required>
            @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </div>

    </form>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $.blockUI.defaults.css = {};
            $('#loginForm').submit(function () {
                $.blockUI({
                    message: $('#loader'),
                    css: {
                        padding: 0,
                        margin: 0,
                        width: '30%',
                        top: '40%',
                        left: '35%',
                        textAlign: 'center',
                        cursor: 'wait'
                    }
                });
            });
        });
    </script>
@endsection
