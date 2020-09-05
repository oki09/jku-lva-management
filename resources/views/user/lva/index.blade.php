@extends('user.layouts.app')

@section('content')
    <h2 class="text-center">{{__('Course overview')}}</h2>
    <div class="overflow-auto" style="height: 75vh">
        @if(count($lvas) > 0)
            <table class="responsiveTable table table-sm">
                <thead>
                <th>Nr.</th>
                <th>{{__('Title')}}</th>
                <th>ECTS</th>
                <th>{{__('Course disabled')}}
                    <a class="popup" href="#" data-toggle="tooltip"
                       title="{{__('Disabled courses do not appear in the calendar')}}"><i
                            class="far fa-question-circle"></i></a>
                </th>
                <th>{{__('Workload')}}
                    <a class="popup" href="#" data-toggle="tooltip" data-html="true"
                       title="{!! __('The ample indicator shows the relation between the capacity and the number of students intend to do this course. <br>Green: <80%<br>Yellow: >=80% AND <95%<br>Red: >=95%') !!}">
                        <i class="far fa-question-circle"></i>
                    </a>
                </th>
                <th></th>
                </thead>
                <tbody>
                @foreach($lvas as $lva)
                    <tr>
                        <td class="lvaNr" data-label="Nr.">{{$lva->nr}}</td>
                        <td data-label="{{__('Title')}}">{{$lva->title}}</td>
                        <td data-label="ECTS">{{$lva->ects}}</td>
                        <td data-label="{{__('Course disabled')}}">
                            @if(count($lva->slots) > 0)
                                <label class="switch">
                                    <input type="checkbox" class="disablingLva"
                                           @if(!$lva->isDisabled) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            @else
                                <span class="text-danger">Keine Termine gefunden!</span>
                            @endif
                        </td>
                        <td data-label="{{__('Workload')}}">
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
                                <i class="fas fa-trash text-danger"></i>
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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
