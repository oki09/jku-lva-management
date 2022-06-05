@extends('layouts.main')

@section('content')
    <p class="text-info mt-2">{{__('You want to drop us a message? Feel free to use the contact form below.')}}</p>
    <form method="POST" action="{{route('info.contact')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control @error('name') is-invalid @enderror" autocomplete="name"
                   autofocus type="text" id="name" name="name" value="{{old('name')}}"
                   placeholder="{{__('Your name')}}" required>
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">E-Mail</label>
            <input class="form-control @error('email') is-invalid @enderror" autocomplete="email"
                   autofocus type="email" id="email" name="email" value="{{old('email')}}"
                   placeholder="{{__('Your email')}}" required>
            @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control @error('message') is-invalid @enderror" type="text" id="message"
                      name="message"
                      placeholder="{{__('Your message')}}..."
                      rows="5" required>{{old('message')}}</textarea>
            @error('message')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <button id="submitBtn" class="btn btn-outline-primary" type="submit">{{__('Submit')}}</button>
    </form>
    @if(session()->has('isSent'))
        @if(session('isSent'))
            <p class="text-success mt-2">{{__('Thank you for your feedback. Your message will reach us shortly.')}}</p>
        @else
            <p class="text-danger mt-2">
                {{__('Something went wrong, while sending the message. Please contact us on')}}:
                <mark><a href="mailto: {{env('MAIL_TO_ADDRESS')}}"> {{env('MAIL_TO_ADDRESS')}}</a></mark>
            </p>
        @endif
    @endif
@endsection
