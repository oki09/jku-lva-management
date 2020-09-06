@extends('admin.layouts.app')

@section('content')
    Nr. of Users: {{count($users)}}
    <div class="mt-3">
        <table class="table table-striped table-hover table-sm text-center table-responsive-md">
            <thead>
            <th>Username</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th># Courses</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>
                        {{$user->studentId}}
                    </th>
                    <td>
                        {{date('d.m.y H:i:s', strtotime($user->created_at))}}
                    </td>
                    <td>
                        {{date('d.m.y H:i:s', strtotime($user->updated_at))}}
                    </td>
                    <td>
                        @if(isset($user->courses))
                            {{count($user->courses)}}
                        @else
                            0
                        @endif

                    </td>
                    <td>
                        <a href="{{route('admin.destroyUser', ['user' => $user->studentId])}}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
