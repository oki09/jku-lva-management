@extends('layouts.main')
@section('content')

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h1 class="display-3">{{__('Welcome fellow JKU students')}} &#129299</h1>
        <p class="lead">{{__('If you are seeing this, then we want to thank you for using this
website and supporting our idea! We are also students of the JKU Linz and we had many conversations with other students
who wished a system where they could create and manage their planned timetables BEFORE the
actual JKU course registration time in a digital manner. Why paper and pen, if there are smartphones and computers right? The main
idea is to detect course overlaps beforehand and give other students the opportunity to plan their semester efficiently.
We call this the CMSS (Course Management System for Students).')}}</p>
        <a href="{{route('calendar.index')}}" class="btn btn-primary btn-lg col-md-2 col-12">{{__('Start now!')}}</a>
    </header>

    <!-- Page Features -->
    <div class="row text-center">

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{asset('images/rsz_timetable.png')}}" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{__('Embedded calendar')}}</h4>
                    <p class="card-text">{{__('See which courses overlap in an instant. A preliminary timetable so to say. ')}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{asset('images/rsz_lvalist.png')}}" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{__('Course management')}}</h4>
                    <p class="card-text">{{__('Add courses or delete them as you wish. Nevertheless, you always have an
                        overview of the added courses. You can also disable courses in order to manage your semester more.')}}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{__('Course workload')}}</h4>
                    <p class="card-text">
                        {{__('This feature shows how many other students intend to visit the course you selected.
This could provide students a second guess of whether they really want to attend the course and give others a better chance.')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
