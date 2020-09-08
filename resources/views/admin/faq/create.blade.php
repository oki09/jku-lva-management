@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.faq.store')}}">
        @csrf
        <h4>English Version</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="question_en">Question</label>
                <textarea type="text" rows="4" class="form-control" name="question_en" id="question_en"
                          required>{{old('question_en')}}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="answer_en">Answer</label>
                <textarea type="text" rows="4" class="form-control" name="answer_en" id="answer_en"
                          required>{{old('answer_en')}}</textarea>
            </div>
        </div>
        <h4>German Version</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="question_de">Question</label>
                <textarea type="text" rows="4" class="form-control" name="question_de" id="question_de"
                          required>{{old('question_de')}}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="answer_de">Answer</label>
                <textarea type="text" rows="4" class="form-control" name="answer_de" id="answer_de"
                          required>{{old('answer_de')}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
