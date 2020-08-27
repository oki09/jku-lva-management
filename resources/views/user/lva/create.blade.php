@extends('user.layouts.app')

@section('content')
    <p class="text-info">{{__('Here you can explore the courses you plan to attend. Just type in the course id or any term like you would do in the KUSSS system.')}}</p>
    <div class="form-group form-inline">
        <input id="lvaNr" type="text" class="form-control col-9 mr-3" placeholder="LVA-Nr.">
        <button id="searchBtn" type="submit" class="btn btn-outline-primary col-2" disabled>{{__('Search')}}</button>
    </div>
    <div id="searchResults">
        @include('user.lva.ajaxData')
    </div>

    <script>
        $(function () {
            $('#lvaNr').on('keyup', function () {
                if ($(this).val() == '') {
                    $('#searchBtn').prop('disabled', true);
                } else {
                    $('#searchBtn').prop('disabled', false);
                }
            });

            $('#searchBtn').on('click', function () {
                let searchQuery = $('#lvaNr').val().trim();
                searchQuery = searchQuery.replaceAll(' ', '+');
                let url = 'https://www.kusss.jku.at/kusss/coursecatalogue-searchlvareg.action?sortParam0courses=lvaName&asccourses=true&abhart=all&lvasearch=' + searchQuery;
                url = '{{ route('proxy') }}?url=' + encodeURIComponent(url);
                $.get({
                    url: url,
                    success: function (response) {
                        const html = $($.parseHTML(response));
                        const foundLvas = html.find("div.contentcell>table>tbody tr");
                        let lvaList = [];
                        foundLvas.each(function (i) {
                            if (i > 2) {
                                const lvaNr = $(this).find('td>b>a').text().trim();
                                if (lvaNr) {
                                    const lvaSlotsUrl = encodeURIComponent($(this).find('td>b>a').attr('href'));
                                    const lvaName = $(this).find('td>a>b').text().trim();
                                    const lvaEcts = $(this).find("td[align=\"center\"]:nth-child(7)").text().trim();
                                    lvaList.push({
                                        lvaNr: lvaNr,
                                        lvaSlotsUrl: lvaSlotsUrl,
                                        lvaName: lvaName,
                                        lvaEcts: lvaEcts
                                    });
                                }
                            }

                        });
                        $.post({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{route('lva.getLvaList')}}',
                            data: JSON.stringify(lvaList),
                            success: function (data) {
                                const $data = $(data);
                                $('#searchResults').hide().html($data).fadeIn();
                            }
                        });
                    },
                    error: function (error) {
                        console.log(error);
                        alert("Fehler");
                    }
                });
            });
        });
    </script>

@endsection
