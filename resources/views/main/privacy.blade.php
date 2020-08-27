@extends('layouts.main')

@section('content')
    <div class="mt-3">
        <div class="float-right">
            <select class="form-control" id="langSelect" name="langs">
                <option selected value="en">Englisch</option>
                <option value="de">Deutsch</option>
            </select>
        </div>
        <div id="privacyText">
            @include('main.privacyLang.en')
        </div>
    </div>
    <script>
        $(function () {
            $('select').change(function () {
                const lang = $('select option:selected').val();
                $.get({
                    url: '{{route('info.privacy')}}?lang=' + lang,
                    success: function (data) {
                        const $data = $(data);
                        $('#privacyText').hide().html($data).fadeIn();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
