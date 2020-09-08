@extends('admin.layouts.app')

@section('content')
    <div class="mt-3">
        <table id="coursesTable" class="table table-striped table-hover table-sm text-center table-responsive-md">
            <thead>
            <th>Course ID</th>
            <th>Title</th>
            <th>ECTS</th>
            <th>Capacity</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Is disabled?</th>
            <th># Slots</th>
            <th></th>
            </thead>
        </table>
    </div>

    <script>
        $(function () {
            $('#coursesTable').DataTable({
                order: [[7, 'desc'], [1, 'desc']],
                ordering: true,
                data: @json($courses),
                columns: [
                    {data: 'nr'},
                    {data: 'title'},
                    {data: 'ects', orderable: false,},
                    {data: 'capacity'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {data: 'isDisabled', orderable: false,},
                    {
                        data: null,
                        render: function (data, type, full, meta) {
                            if (full.slots) return full.slots.length;
                            return 0;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            let deleteUrl = "{{route('admin.user.course.destroy', ['user' => ':id'])}}"
                                .replace(':id', '{{$studentId}}');
                            deleteUrl += '?course=' + full.nr;

                            return '<a href="' + deleteUrl + '"><i class="fas fa-trash"></i></a>';
                        }
                    }
                ]
            });
        });
    </script>
@endsection
