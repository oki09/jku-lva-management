@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.news.store')}}">
        @csrf
        <label for="de">German version</label>
        <textarea type="text" class="form-control" name="de" id="de" required>{{old('de')}}</textarea>
        <label for="en">English version</label>
        <textarea type="text" class="form-control" name="en" id="en" required>{{old('de')}}</textarea>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
