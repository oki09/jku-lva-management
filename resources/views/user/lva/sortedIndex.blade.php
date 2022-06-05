@if(count($lvas) > 0)
    <div class="row">
        @foreach($lvas as $lva)
            <div class="col-md-4 col-lg-3 mb-3">
                <div class="card @if(!$lva->isDisabled) border-primary @else border-secondary text-muted @endif h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-baseline">
                            <h5 class="card-title" style="word-break: break-word">{{$lva->title}}</h5>
                            <div class="ml-auto">
                                <label class="switch">
                                    <input type="checkbox" class="disablingToggle"
                                           @if(!$lva->isDisabled) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted"><span class="lvaNr">{{$lva->nr}}</span>
                            &middot; {{$lva->ects}} ECTS &middot; {{$lva->type}}
                        </h6>
                        <p class="card-text">
                            @if($lva->workload > 0)
                                <span class="@if(($lva->workload/$lva->capacity) <= 80) text-success
                                @elseif(($lva->workload/$lva->capacity) > 80 && ($lva->workload/$lva->capacity) <= 95) text-warning
                                @else text-danger
                                @endif">{{round($lva->workload/$lva->capacity*100, PHP_ROUND_HALF_UP)}}% {{__('full')}}</span>
                            @else
                                <span class="text-success">0% {{__('full')}}</span>
                            @endif
                            <br>
                            @if(count($lva->slots) > 0)
                                {{count($lva->slots)}} {{__('appointments')}}
                            @else
                                <span class="text-danger">{{__('No appointments found')}}</span>
                            @endif
                            <br>
                            @if(count(explode('&', $lva->teachers)) > 0)
                                <span class="font-weight-bolder">{{__('Teachers')}}:</span><br>
                                @foreach(explode('&', $lva->teachers) as $teacher)
                                    {{$teacher}}@if (!$loop->last),@endif
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('lva.destroy', ['lva' => $lva->nr])}}"
                           class="lvaDestroy btn btn-outline-danger w-100">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
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
            $('.disablingToggle').on('click', function () {
                const card = $(this).closest('.card');
                const lvaNr = card.find('.lvaNr').text();
                const checked = $(this).prop('checked');
                if (checked){
                    card.toggleClass('border-primary border-secondary');
                    card.removeClass('text-muted')
                }
                else{
                    card.toggleClass('border-secondary border-primary');
                    card.addClass('text-muted')
                }
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

