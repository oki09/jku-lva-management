@extends('user.layouts.app')

@section('content')
    @if(count($lvas) > 0)
        <button class="btn btn-primary" id="toTheTopBtn">
            <i class="fas fa-chevron-up"></i>
        </button>
        <div class="row">
            @foreach($lvas as $lva)
                <div class="col-md-3 mb-3">
                    <div class="card border-dark h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-baseline">
                                <h5 class="card-title" style="word-break: break-word">{{$lva->title}}</h5>
                                <div class="ml-auto">
                                    <label class="switch">
                                        <input type="checkbox" class="disablingToggle"
                                               @if(!$lva->isDisabled) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                <!--<a class="popup" href="#" data-toggle="tooltip"
                                           title="{{__('Disabled courses do not appear in the calendar. More info in the FAQs.')}}"><i
                                                class="far fa-question-circle"></i></a>-->
                                </div>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted"><span class="lvaNr">{{$lva->nr}}</span>
                                | {{$lva->ects}} ECTS | {{$lva->capacity}} {{__('mögl.')}}
                            </h6>
                            <p class="card-text">
                                +{{$lva->workload}} {{__('weitere Studenten')}}<br>
                                @if(isset($lva->handbookUrl))
                                    <a target="_blank" href="{{$lva->handbookUrl}}">{{__('Study Handbook')}}</a>
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
                const $btn = $('#toTheTopBtn');

                window.onscroll = function () {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $btn.show();
                    } else {
                        $btn.hide();
                    }
                };

                $('#toTheTopBtn').on('click', function () {
                    // this changes the scrolling behavior to "smooth"
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });

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
                    const lvaNr = $(this).closest('.card-body').find('.lvaNr').text();
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
