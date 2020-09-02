@extends('layouts.main')
@section('content')
    <header class="jumbotron my-4">
        <h1 class="display-3">{{__('Welcome JKU students')}} &#129299</h1>
        <p class="lead">
            {{__('This tool should help other students who face similar problems like us.
We are two students from the JKU and always had the problem of managing our planned courses for the upcoming semester.
Especially, if the JKU publishes the list of available semester courses, there is no way to find overlaps between courses
or plan the semester without wasting many hours of the day. Without wasting too much words, feel free to explore this
CMSS (Course Management System for Students) application and if you have any feedback or feature wishes then contact us
on the')}}
            <a href="{{route('info.contact')}}"> {{__('Contact')}}</a>{{__('. Thank you for your support and happy planning!')}}
        </p>
        <a href="{{route('calendar.index')}}" class="btn btn-primary btn-lg col-md-2 col-12">{{__('Start now!')}}</a>
    </header>

    <div class="row text-center">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-bottom" src="{{asset('images/weekViewCalendar.png')}}" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{__('Embedded calendar')}}</h4>
                    <p class="card-text">{{__('See which courses overlap in an instant. A preliminary timetable so to say.')}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img class="card-img-bottom" src="{{asset('images/courseList.png')}}" alt="Course list">
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
