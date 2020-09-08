@extends('admin.layouts.app')

@section('content')
    <a class="btn btn-outline-primary" href="{{route('admin.faq.create')}}">Add</a>
    <table class="table mt-3">
        <thead>
        <th>Id</th>
        <th>Question</th>
        <th>Answer</th>
        <td></td>
        </thead>
        <tbody>
        @foreach($faqs as $faq)
            <tr>
                <td><a href="{{route('admin.faq.edit', ['id' => $faq->_id])}}">{{$faq->_id}}</a></td>
                <td>{!! $faq->question_en !!}</td>
                <td>{!! $faq->answer_en !!}</td>
                <td>
                    <a href="{{route('admin.faq.destroy', ['id' => $faq->_id])}}" class="text-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
