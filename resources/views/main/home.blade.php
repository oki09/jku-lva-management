@extends('layouts.main')
@section('content')
    <div class="alert alert-info alert-dismissible mt-3" role="alert">
        <h4>News</h4>
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span>
        </button>
        {!! __('Dear students, we prepared a little questionnaire for you &#128522. We would like you to answer the six questions, so that we know if we should continue this project. Thanks in advance!') !!}
        <a href="https://forms.gle/fYgAXJoHuB45dsYz5" target="_blank">{{__('Click here to get to the questionnaire.')}}</a>
    </div>
    <header class="jumbotron my-4">
        <h1 class="display-3">{{__('Welcome JKU students')}} &#129299</h1>
        <p class="lead">
            {!!__('The planning of the new semester is really exhausting and time-consuming &#8987. No matter if it is the creation of the timetables, the finding of overlaps or the recognizing of stressful phases. The process is always stressful.') !!}
        </p>
        <p class="lead">
            {!! __('EduSmart supports, automates and partly eases the semester planning. With a few clicks, available courses can be searched and added to a personal list. Meanwhile, EduSmart generates a personal calendar, which recognizes overlaps and marks them accordingly. Pretty &#127378, right?') !!}
        </p>
        <p class="lead">
            {!! __('You can support us with new ideas or cool feature wishes. To contact us use the') !!} <a
                href="{{route('info.contact')}}">{{__('contact form')}}</a>.
            {!! __('With EduSmart, we hope to ease the coming semester and wish you a happy planning!') !!}
        </p>
        <a href="{{route('calendar.index')}}" class="btn btn-primary btn-lg col-md-2 col-12">{{__('Start now!')}}</a>
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
                    <h4 class="card-title">{{__('Course management and workload')}}</h4>
                    <p class="card-text">{{__('Add courses or delete them as you wish. Nevertheless, you always have the overview of your courses. You can also disable courses in order to be more flexible in planning.')}}
                    </p>
                    <p class="card-text">
                        {{__('See how many other students intend to visit the course you selected. This could provide students a second guess of whether they really want to attend the course and give others a better chance.')}}
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
                        {{__('The cherry on the top is the fully responsive design, so you can also plan with your smartphone.')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
