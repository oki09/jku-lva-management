@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.changeSemester')}}" class="form-inline">
        @csrf
        <div class="form-group mb-2 mr-2">
            <label for="semesterStart" class="col-form-label mr-2">Semesterstart:</label>
            <input type="text" id="semesterStart" class="form-control" name="semesterStart"
                   value="{{config('app.semesterStart')}}">
        </div>
        <button type="submit" class="btn btn-outline-dark col-sm-2">Ändern</button>
    </form>
    <div class="mt-3">
        <table class="table table-striped table-hover">
            <thead>
            <th>Username</th>
            <td>Created at</td>
            <td>Updated at</td>
            <td></td>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>
                        {{$user->studentId}}
                    </th>
                    <td>
                        {{$user->created_at}}
                    </td>
                    <td>
                        {{$user->updated_at}}
                    </td>
                    <td>
                        <a href="{{route('admin.destroyUser', ['user' => $user->studentId])}}">
                            <i class="fas fa-trash-o text-danger"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
