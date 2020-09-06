@extends('layouts.main')

@section('content')
    <div class="alert alert-warning alert-dismissible mt-3" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span>
        </button>
        {{__('This section contains information related to EduSmart. If you cannot find an answer to your question, make sure to contact us.')}}
    </div>
    <div id="accordion">
        <div class="card">
            <div class="card-header h6">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                    {{__('Who is behind EduSmart?')}}
                </a>
            </div>
            <div id="collapseFour" class="panel-collapse collapse in">
                <div class="card-body">
                    <p class="card-text">{!! __('EduSmart is developed and maintained by two students of the JKU. For privacy reasons, the names will be withhold. However, you can contact us anytime to meet us personally &#128516') !!}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header h6">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    {{__('What is the idea behind EduSmart?')}}
                </a>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="card-body">
                    <p class="card-text">{!! __('EduSmart should help students before or during the actual registration dates. The core features are: Detecting course overlaps and stressful phases, the embedded calendar, searching for courses and the responsive design. However, EduSmart <strong>IS NOT</strong> a KUSSS substitute, interpret it more as a supplement to the KUSSS system.') !!}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header h6">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    {{__('Why do I need to provide my KUSSS credentials?')}}
                </a>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="card-body">
                    <p class="card-text">{{__('EduSmart retrieves the data from the KUSSS system. Therefore, your KUSSS credentials are needed in order to verify your identity and link your selected courses the an account. No worries though: Your password will be hashed with the famous Bcrypt algorithm.')}}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header h6">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    {{__('What happens when a new semester is imminent?')}}
                </a>
            </div>
            <div id="collapseThree" class="panel-collapse collapse in">
                <div class="card-body">
                    <p class="card-text">{{__('After the end of a semester, the data will be deleted and if the course list for the upcoming semester is available, students will be able to plan their semester again.')}}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header h6">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                    {{__('What is the "course disabled" toggle?')}}
                </a>
            </div>
            <div id="collapse5" class="panel-collapse collapse in">
                <div class="card-body">
                    <p class="card-text">{{__('This option can be used for disabling single courses. Disabled courses do not appear in the calendar, but are counted to the total ECTS. If you need to know how your timetable would look like without this course, then you do not need to delete it and add it every time.')}}</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header h6">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                    {{__('What is the "course workload" indicator?')}}
                </a>
            </div>
            <div id="collapse6" class="panel-collapse collapse in">
                <div class="card-body">
                    <p class="card-text">{!!__('This ample indicator shows how popular the selected course is, meaning how many other students indent to attend the course and if the capacity is sufficient enough. The breakdown is as follows:<br/>Green: <80%<br/>Yellow: >=80% AND <95%<br/>Red: >=95%') !!}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

