@extends('admin.layouts.app')

@section('content')
    <a class="btn btn-outline-primary" href="{{route('admin.news.create')}}">Add</a>
    <table class="table">
        <thead>
        <th>Id</th>
        <th>German version</th>
        <th>English version</th>
        <td></td>
        </thead>
        <tbody>
        @foreach($news as $new)
            <tr>
                <td><a href="{{route('admin.news.edit', ['id' => $new->_id])}}">{{$new->_id}}</a></td>
                <td>{!! $new->de !!}</td>
                <td>{!! $new->en !!}</td>
                <td>
                    <a href="{{route('admin.news.destroy', ['id' => $new->_id])}}" class="text-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
