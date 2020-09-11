@extends('user.layouts.app')

@section('content')
    <div class="input-group mb-2">
        <input id="lvaNr" type="text" class="form-control" placeholder="{{__('Query')}}">
        <div class="input-group-append">
            <button id="searchBtn" type="submit" class="btn btn-outline-primary" style="width: 5em">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div id="searchResults">
        @include('user.lva.ajaxData')
    </div>
    <button class="btn btn-primary" id="toTheTopBtn">
        <i class="fas fa-chevron-up"></i>
    </button>
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

            const $btn = $('#toTheTopBtn');

            window.onscroll = function () {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    $btn.show();
                } else {
                    $btn.hide();
                }
            };

            $('#toTheTopBtn').on('click', function () {
                // this changes the scrolling behavior to "smooth"
                window.scrollTo({top: 0, behavior: 'smooth'});
            });

            $('#lvaNr').keypress(function (e) {
                const key = e.which;
                if (key == 13) // the enter key code
                {
                    $('#searchBtn').click();
                    return false;
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
                                    let lvaType = $(this).find('td:nth-child(3)').text().trim();
                                    lvaName = lvaType.concat(' ', lvaName);
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
                                $('#searchResults').hide().html($data).show();
                            },
                            error: function (error) {
                                const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                                $('#searchResults').hide().html($data).show();
                            }
                        });
                    },
                    error: function (error) {
                        const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                        $('#searchResults').hide().html($data).show();
                    }
                });
            });
        });
    </script>

@endsection
