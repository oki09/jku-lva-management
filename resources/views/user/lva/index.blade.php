@extends('user.layouts.app')

@section('content')
    <div>
        @if(count($lvas) > 0)
            <table class="table table-hover table-striped w-full table-sm responsive">
                <thead>
                <th style="width: 30px">{{__('Nr.')}}</th>
                <th>{{__('Name')}}</th>
                <th style="width: 30px">{{__('ECTS')}}</th>
                <th style="text-align: center">{{__('LVA deaktiviert')}}
                    <a class="popup" href="#" data-toggle="tooltip"
                       title="{{__('Disabled courses do not appear in the calendar')}}">?</a>
                </th>
                <th>{{__('Workload')}}
                    <a class="popup" href="#" data-toggle="tooltip"
                       title="{{__('The ample indicator shows the planned workload of the course.
Green -> Course capacity is under 80%, Yellow -> Course capacity is between 80 and 95%, Red -> Course capacity is over 95%')}}">?</a>
                </th>
                <th></th>
                </thead>
                <tbody>
                @foreach($lvas as $lva)
                    <tr>
                        <th class="lvaNr">{{$lva->nr}}</th>
                        <td>{{$lva->title}}</td>
                        <td>{{$lva->ects}}</td>
                        <td style="text-align: center">
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
                        <td><a href="{{route('lva.destroy', ['lva' => $lva->nr])}}">
                                <i class="fas fa-trash-o text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <script>
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
            </script>
        @else
            <p class="alert-info">{{__('It seems like you did not add courses to your dashboard. Go to LVA-Management > Add LVA for adding your courses.')}}</p>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
