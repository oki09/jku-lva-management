@extends('layouts.main')

@section('content')
    <div class="alert alert-warning alert-dismissible mt-3" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span>
        </button>
        {{__('This section contains information related to EduSmart. If you cannot find an answer to your question, make sure to contact us.')}}
    </div>
    <div id="accordion" class="my-3">
        @foreach($faqs as $faq)
            @if(app()->getLocale() == 'de')
                <div class="card">
                    <div class="card-header h6">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse{{$loop->iteration}}">
                            {!! $faq->question_de !!}
                        </a>
                    </div>
                    <div id="collapse{{$loop->iteration}}" class="panel-collapse collapse in">
                        <div class="card-body">
                            <p class="card-text">{!! $faq->answer_de !!}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header h6">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse{{$loop->iteration}}">
                            {!! $faq->question_en !!}
                        </a>
                    </div>
                    <div id="collapse{{$loop->iteration}}" class="panel-collapse collapse in">
                        <div class="card-body">
                            <p class="card-text">{!! $faq->answer_en !!}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection

