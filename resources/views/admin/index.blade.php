@extends('admin.layouts.app')

@section('content')
    <div class="mt-3">
        <table id="usersTable" class="table table-striped table-hover table-sm text-center table-responsive-md">
            <thead>
            <th>Student ID</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th># Courses</th>
            <th></th>
            </thead>
        </table>
    </div>

    <script>
        $(function () {
            $('#usersTable').DataTable({
                order: [[3, 'desc'], [1, 'desc']],
                ordering: true,
                data: @json($users),
                columns: [
                    {
                        data: 'studentId',
                        render: function (data, type, full, meta) {
                            const showUrl = "{{route('admin.user.show', ['user' => ':id'])}}".replace(':id', data);
                            return '<a href="' + showUrl + '">' + data + '</a>';
                        }
                    },
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {
                        data: null,
                        render: function (data, type, full, meta) {
                            if (full.courses) return full.courses.length;
                            return 0;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            const deleteUrl = "{{route('admin.user.destroy', ['user' => ':id'])}}".replace(':id', full.studentId);
                            return '<a href="' + deleteUrl + '"><i class="fas fa-trash"></i></a>';
                        }
                    }
                ]
            });
        });
    </script>
@endsection
