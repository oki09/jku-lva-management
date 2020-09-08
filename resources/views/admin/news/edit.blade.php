@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.news.store')}}">
        <input type="hidden" name="id" id="id" value="{{$news->_id}}">
        @csrf
        <div class="form-group">
            <label for="de">German version</label>
            <textarea type="text" rows="8" class="form-control" name="de" id="de"
                      required>{{old('de', $news->de)}}</textarea>
        </div>
        <div class="form-group">
            <label for="en">English version</label>
            <textarea type="text" rows="8" class="form-control" name="en" id="en"
                      required>{{old('en', $news->en)}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('admin.news.index')}}">Go back</a>
    </form>
@endsection
