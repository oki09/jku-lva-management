@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.news.store')}}">
        <input type="hidden" name="id" id="id" value="{{$news->_id}}">
        @csrf
        <label for="de">German version</label>
        <textarea type="text" cols="8" class="form-control" name="de" id="de" required>{{old('de', $news->de)}}</textarea>
        <label for="en">English version</label>
        <textarea type="text" cols="8" class="form-control" name="en" id="en" required>{{old('en', $news->en)}}</textarea>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
