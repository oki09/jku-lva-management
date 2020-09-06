@extends('admin.layouts.app')

@section('content')
    <div class="d-flex flex-row align-items-center">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <a type="button" class="btn btn-outline-primary"
               href="{{route('admin.settings.maintenance', ['mode' => 'activate'])}}">Down</a>

            <a type="button" class="btn btn-outline-primary"
               href="{{route('admin.settings.maintenance', ['mode' => 'deactivate'])}}">Up</a>
        </div>
    </div>
@endsection
