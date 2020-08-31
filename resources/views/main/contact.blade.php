@extends('layouts.main')

@section('content')
    <p class="text-info mt-2">{{__('Have you detected bugs or encountered features that you wish, then simply drop us a message below. If the feedback form should not work for some reasons, then you can also send your inquiry manually to')}}
        <mark><a href="mailto: {{env('MAIL_TO_ADDRESS')}}"> {{env('MAIL_TO_ADDRESS')}}</a></mark>.
    </p>
    <form method="POST" action="{{route('info.contact')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control @error('name') is-invalid @enderror" autocomplete="name"
                   autofocus type="text" id="name" name="name" value="{{old('name')}}"
                   placeholder="Your name">
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input class="form-control @error('email') is-invalid @enderror" autocomplete="email"
                   autofocus type="email" id="email" name="email" value="{{old('email')}}"
                   placeholder="Your E-Mail">
            @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control @error('message') is-invalid @enderror" type="text" id="message"
                      name="message"
                      placeholder="{{__('Your message')}}..."
                      rows="5">{{old('message')}}</textarea>
            @error('message')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <button id="submitBtn" class="btn btn-outline-primary" type="submit">{{__('Submit')}}</button>
    </form>
    @if(session()->has('isSent'))
        @if(session('isSent'))
            <p class="text-success mt-2">{{__('Thank you for your feedback. Your message will soon arrive at the admins.')}}</p>
        @else
            <p class="text-danger mt-2">{{__('Something went wrong. This incident will be reported to the admins.')}}</p>
        @endif
    @endif
@endsection
