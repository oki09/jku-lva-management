@extends('user.layouts.app')

@section('content')
    <div class="form-row mt-5">
        <div class="col-md-9 mb-3">
            <input id="lvaNr" type="text" class="form-control" placeholder="LVA-Nr.">
        </div>
        <div class="col-md-3">
            <button id="searchBtn" type="button" class="btn w-100 btn-outline-primary" disabled>{{__('Search')}}</button>
        </div>
    </div>
    <div id="searchResults" class="mt-3">
        @include('user.lva.ajaxData')
    </div>

    <script>
        $(document).ready(function () {
            $('#lvaNr').on('keyup', function () {
                if ($(this).val() == '') {
                    $('#searchBtn').prop('disabled', true);
                } else {
                    $('#searchBtn').prop('disabled', false);
                }
            });

            $('#searchBtn').on('click', function () {
                let url = 'https://www.kusss.jku.at/kusss/coursecatalogue-searchlvareg.action?sortParam0courses=lvaName&asccourses=true&abhart=all&lvasearch=' + $('#lvaNr').val().trim();
                url = '{{ route('proxy') }}?url=' + encodeURIComponent(url);
                $.get({
                    url: url,
                    success: function (response) {
                        const html = $($.parseHTML(response));
                        const lvaNr = html.find("div.contentcell>table>tbody>tr>td>b>a").text().trim();
                        let lvaSlotsUrl = html.find("div.contentcell>table>tbody>tr>td>b>a").attr('href');
                        lvaSlotsUrl = encodeURIComponent(lvaSlotsUrl);
                        const lvaName = html.find("div.contentcell>table>tbody>tr>td>a>b").text().trim();
                        const lvaEcts = html.find("div.contentcell>table>tbody>tr>td[align=\"center\"]:nth-child(7)").text().trim();
                        $.get({
                            url: '{{route('lva.create')}}?lvaNr=' + lvaNr + '&lvaName=' + lvaName + '&lvaEcts=' + lvaEcts + '&lvaSlotsUrl=' + lvaSlotsUrl,
                            success: function (data) {
                                const $data = $(data);
                                $('#searchResults').hide().html($data).fadeIn();
                            }
                        });
                    },
                    error: function (error) {
                        console.log(error);
                        $.get({
                            url: '{{route('lva.create')}}?lvaNr=&lvaName=&lvaEcts=&lvaSlotsUrl=',
                            success: function (data) {
                                const $data = $(data);
                                $('#searchResults').hide().html($data).fadeIn();
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection
