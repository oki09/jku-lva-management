@extends('layouts.main')
@section('content')
    <div class="alert alert-info alert-dismissible mt-3" role="alert">
        <h4>{{__('What\'s new?')}}</h4>
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span>
        </button>
        <ul>
            @foreach($news as $new)
                <li>
                    @if(app()->getLocale() == 'de')
                        {!! $new->de !!}
                    @else
                        {!! $new->en !!}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <header class="jumbotron my-4">
        <h1 class="display-3">{{__('Welcome JKU students')}} &#129299</h1>
        <p class="lead">
            {!!__('The planning of the new semester is really exhausting and time-consuming &#8987. No matter if it is the creation of the timetables, the finding of overlaps or the detecting of stressful phases. The process is always stressful.') !!}
        </p>
        <p class="lead">
            {!! __('EduSmart aims to support, automate and partly ease the semester planning. With a few clicks, available courses can be searched and added to a personal list. Meanwhile, EduSmart generates a personal calendar, which detects overlaps and marks them accordingly. Pretty &#127378, right?') !!}
        </p>
        <p class="lead">
            {!! __('If you like the idea, then support us with new ideas or cool feature wishes. To contact us use the') !!}
            <a
                href="{{route('info.contact')}}">{{__('contact form')}}</a>.
            {!! __('With EduSmart, we hope to ease the coming semester and wish you a happy planning!') !!}
        </p>
        <a href="{{route('calendar.index')}}" class="btn btn-primary btn-lg col-md-3 col-12">{{__('Start now!')}}</a>
    </header>

    <div class="row text-center">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-bottom" src="{{asset('images/calendar-view.png')}}" alt="Calendar View EduSmart">
                <div class="card-body">
                    <h4 class="card-title">{{__('Embedded calendar')}}</h4>
                    <p class="card-text">{{__('See which courses overlap in an instant. A preliminary timetable so to say.')}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-bottom" src="{{asset('images/course-view.png')}}" alt="Course list view EduSmart">
                <div class="card-body">
                    <h4 class="card-title">{{__('Course management')}}</h4>
                    <p class="card-text">{{__('Managing your courses was never easier. Add, delete or disable your courses as you wish. The main goal is to be more flexible during the planning.')}}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-bottom" src="{{asset('images/calendar_portrait.png')}}"
                     alt="Calendar view on IPhone X">
                <div class="card-body">
                    <h4 class="card-title">{{__('Fully responsive')}}</h4>
                    <p class="card-text">
                        {{__('EduSmart is optimized for mobile usage, therefore you can always change things on the go.')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
