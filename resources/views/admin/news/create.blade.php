@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.news.store')}}">
        @csrf
        <div class="form-group">
            <label for="de">German version</label>
            <textarea type="text" rows="8" class="form-control" name="de" id="de" required>{{old('de')}}</textarea>
        </div>
        <div class="form-group">
            <label for="en">English version</label>
            <textarea type="text" rows="8" class="form-control" name="en" id="en" required>{{old('de')}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
