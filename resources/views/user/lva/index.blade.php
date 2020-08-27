@extends('user.layouts.app')

@section('content')
    <div class="overflow-auto" style="height: 80vh">
        @if(count($lvas) > 0)
            <table class="table table-hover table-striped w-full table-sm responsive">
                <thead>
                <th>Nr.</th>
                <th>Name</th>
                <th>ECTS</th>
                <th>{{__('Course disabled')}}
                    <a class="popup" href="#" data-toggle="tooltip"
                       title="{{__('Disabled courses do not appear in the calendar')}}"><i
                            class="far fa-question-circle"></i></a>
                </th>
                <th class="text-center">{{__('Workload')}}
                    <a class="popup" href="#" data-toggle="tooltip"
                       title="{{__('The ample indicator shows the relation between the capacity and the number of students intend to do this course.
Green: <80%, Yellow: >=80% AND <95%, Red: >=95%')}}">
                        <i class="far fa-question-circle"></i>
                    </a>
                </th>
                <th></th>
                </thead>
                <tbody>
                @foreach($lvas as $lva)
                    <tr>
                        <th class="lvaNr">{{$lva->nr}}</th>
                        <td>{{$lva->title}}</td>
                        <td>{{$lva->ects}}</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" class="disablingLva"
                                       @if($lva->isDisabled == 'true') checked @endif>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            @if($lva->workload < 80)
                                <span class="dot-green"></span>
                            @elseif($lva->workload >= 80 && $lva->workload < 95)
                                <span class="dot-yellow"></span>
                            @else
                                <span class="dot-green"></span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('lva.destroy', ['lva' => $lva->nr])}}">
                                <i class="fas fa-trash-o text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <script>
                $(function () {
                    $('.disablingLva').on('click', function () {
                        const lvaNr = $(this).closest('tr').find('.lvaNr').text();
                        const checked = $(this).prop('checked');
                        console.log(checked);
                        $.post({
                            url: '{{route('lva.disable')}}',
                            data: {
                                lvaNr: lvaNr,
                                disabling: checked
                            },
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            error(error) {
                                console.log(error);
                            }
                        });
                    });
                });

            </script>
        @else
            <p class="alert-info text-center mt-3">{{__('It seems like you did not add courses to your dashboard. Go to Course-Management > Add course to add your courses.')}}</p>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
