@extends('user.layouts.app')

@section('content')
    <p class="text-info">{{__('Here you can explore the courses you plan to attend. Just type in the course id or any term like you would do in the KUSSS system.')}}</p>
    <div class="form-group form-inline">
        <input id="lvaNr" type="text" class="form-control col-md-10 mr-sm-2" placeholder="Suchbegriff" autofocus>
        <button id="searchBtn" type="submit" class="btn btn-outline-primary col-md-1" disabled>{{__('Search')}}</button>
    </div>
    <div id="searchResults">
        @include('user.lva.ajaxData')
    </div>

    <script>
        $(function () {
            //https://stackoverflow.com/questions/23415360/jquery-how-to-edit-html-text-only-for-current-level
            $.fn.ownText = function () {
                return this.eq(0).contents().filter(function () {
                    return this.nodeType === 3 // && $.trim(this.nodeValue).length;
                }).map(function () {
                    return this.nodeValue;
                }).get().join('');
            }

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
                let url = '{{env('KUSSS_LVA_SEARCH')}}'.replaceAll('&amp;', '&') + searchQuery;
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
                                    let lvaName = $(this).find('td>a>b').text().trim();
                                    if (lvaName === 'Special Topics') lvaName = $(this).find('td:nth-child(2)').ownText().trim();
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
                            },
                            error: function (error) {
                                const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                                $('#searchResults').hide().html($data).fadeIn();
                            },
                            beforeSend: function () {
                                $('#loader').show();
                            },
                            complete: function () {
                                $('#loader').hide();
                            }
                        });
                    },
                    error: function (error) {
                        const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                        $('#searchResults').hide().html($data).fadeIn();
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    complete: function () {
                        $('#loader').hide();
                    }
                });
            });
        });
    </script>

@endsection
