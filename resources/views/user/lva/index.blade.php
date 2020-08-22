@extends('user.layouts.app')

@section('content')
    <div>
        @if(count($lvas) > 0)
            <table class="table table-hover table-striped w-full table-sm">
                <thead>
                <th style="width: 30px">{{__('Nr.')}}</th>
                <th>{{__('Name')}}</th>
                <th style="width: 30px">{{__('ECTS')}}</th>
                <th style="text-align: center">{{__('LVA deaktiviert')}}</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($lvas as $lva)
                    <tr>
                        <th class="lvaNr">{{$lva->nr}}</th>
                        <td>{{$lva->title}}</td>
                        <td>{{$lva->ects}}</td>
                        <td style="text-align: center">
                            <label class="switch">
                                <input type="checkbox" class="disablingLva" @if($lva->isDisabled == 'true') checked @endif>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td><a href="{{route('lva.destroy', ['lva' => $lva->nr])}}">
                                <i class="fas fa-trash-o text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <script>
                $('.disablingLva').on('click', function () {
                    const lvaNr = $(this).closest('tr').find('.lvaNr').text();
                    const checked = $(this).prop('checked');
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
            </script>
        @else
            <p>{{__('Noch keine LVAs hinzugefügt')}}</p>
        @endif
    </div>
@endsection
