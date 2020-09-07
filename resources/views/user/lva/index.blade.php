@extends('user.layouts.app')

@section('content')
    <h2 class="text-center">{{__('Course overview')}}</h2>
    <div class="overflow-auto" style="height: 75vh">
        @if(count($lvas) > 0)
            <div id="mobileView">
                @foreach($lvas as $lva)
                    <ul class="list-group my-1">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Nr.</span>
                            <span class="lvaNr">{{$lva->nr}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">{{__('Title')}}</span>
                            <span class="text-right">{{$lva->title}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">ECTS</span>
                            <span class="text-right">{{$lva->ects}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">{{__('Course disabled')}}
                            <a class="popup" href="#" data-toggle="tooltip"
                               title="{{__('Disabled courses do not appear in the calendar. More info in the FAQs.')}}">
                                <i class="far fa-question-circle"></i>
                            </a>
                        </span>
                            @if(count($lva->slots) > 0)
                                <label class="switch">
                                    <input type="checkbox" class="disablingLva"
                                           @if(!$lva->isDisabled) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            @else
                                <span class="text-danger">Keine Termine gefunden!</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">{{__('Workload')}}
                            <a class="popup" href="#" data-toggle="tooltip" data-html="true"
                               title="{{ __('This indicator shows the popularity of this course. More info in the FAQs.') }}">
                                <i class="far fa-question-circle"></i>
                            </a>
                        </span>
                            @if($lva->workload < 80)
                                <span class="dot-green"></span>
                            @elseif($lva->workload >= 80 && $lva->workload < 95)
                                <span class="dot-yellow"></span>
                            @else
                                <span class="dot-green"></span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('lva.destroy', ['lva' => $lva->nr])}}"
                               class="lvaDestroy btn btn-outline-danger w-100">
                                <i class="fas fa-trash"></i>
                            </a>
                        </li>
                    </ul>
                @endforeach
            </div>
            <div id="desktopView">
                <table class="table table-sm">
                    <thead>
                    <th>Nr.</th>
                    <th>{{__('Title')}}</th>
                    <th>ECTS</th>
                    <th>{{__('Course disabled')}}
                        <a class="popup" href="#" data-toggle="tooltip"
                           title="{{__('Disabled courses do not appear in the calendar. More info in the FAQs.')}}"><i
                                class="far fa-question-circle"></i></a>
                    </th>
                    <th>{{__('Workload')}}
                        <a class="popup" href="#" data-toggle="tooltip" data-html="true"
                           title="{!! __('This indicator shows the popularity of this course. More info in the FAQs.') !!}">
                            <i class="far fa-question-circle"></i>
                        </a>
                    </th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($lvas as $lva)
                        <tr>
                            <td class="lvaNr">{{$lva->nr}}</td>
                            <td>{{$lva->title}}</td>
                            <td>{{$lva->ects}}</td>
                            <td>
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
                                <a href="{{route('lva.destroy', ['lva' => $lva->nr])}}" class="lvaDestroy">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(function () {
                    $('.lvaDestroy').on('click', function () {
                        $.blockUI({
                            message: $('#loader'),
                            css: {
                                padding: 0,
                                margin: 0,
                                width: '30%',
                                top: '40%',
                                left: '35%',
                                textAlign: 'center',
                                color: '#000',
                                border: 'none',
                                cursor: 'wait'
                            }
                        });
                    });
                    let isMobile = window.matchMedia("only screen and (max-width: 600px)").matches;
                    $('.disablingLva').on('click', function () {
                        const lvaNr = isMobile ? $(this).closest('ul').find('.lvaNr').text() : $(this).closest('tr').find('.lvaNr').text();
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
