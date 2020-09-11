@if(isset($lvaList))
    @if(count($lvaList) == 0)
        <p class="alert-danger">{{__('No courses found')}}</p>
    @else
        <p>{{count($lvaList) . ' ' . __('Results found')}}</p>
        <div class="row">
            @foreach($lvaList as $lva)
                <div class="col-md-3 mb-3">
                    <div class="card border-dark mb-3">
                        <div class="card-body">
                            <span class="d-none lvaSlotsUrl">{{$lva->lvaSlotsUrl}}</span>
                            <h5 class="card-title title">{{$lva->lvaName}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><span class="lvaNr">{{$lva->lvaNr}}</span>
                                | <span class="ects">{{$lva->lvaEcts}}</span> ECTS
                            </h6>
                        </div>
                        <div class="card-footer successHandler">
                            @if(!$lva->isAdded)
                                <button class="addLvaBtn btn btn-outline-primary w-100">{{__('Add')}}</i>
                                </button>
                            @else
                                <span class="text-danger">{{__('already added')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <script>
        $('.addLvaBtn').on('click', function () {
            const row = $(this).closest('.card');
            let slotsUrl = decodeURIComponent('{{ env('KUSSS_PREFIX')}}' + row.find('.lvaSlotsUrl').text());
            $.get({
                url: getProxyRequestUrl(slotsUrl),
                success(response) {
                    const parsedHtml = $($.parseHTML(response));
                    const slots = retrieveSlots(parsedHtml);
                    const capacity = retrieveLvaCapacity(parsedHtml);
                    const handBookUrl = retrieveLvaHandbookUrl(parsedHtml);
                    console.log(handBookUrl);
                    storeSelectedLva(row, slots, capacity, handBookUrl);
                },
                error(error) {
                    const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                    row.find('.successHandler').hide().html($data).show();
                }
            });
        });

        function storeSelectedLva(row, slots, capacity, handbookUrl) {
            $.post({
                url: '{{route('lva.store')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify({
                    nr: row.find('.lvaNr').text(),
                    title: row.find('.title').text(),
                    ects: row.find('.ects').text(),
                    capacity: capacity,
                    slots: slots,
                    handbookUrl: handbookUrl
                }),
                success() {
                    const successBtn = $('<button class="btn btn-success w-100"><i class="fas fa-check"></i></button>');
                    row.find('.successHandler').hide().html(successBtn).slideDown();
                },
                error(error) {
                    const $data = '<span class="alert-danger">{{__("Something went wrong :/")}}</span>';
                    row.find('.successHandler').hide().html($data).show();
                }
            });
        }

        function retrieveLvaCapacity(html) {
            return html.find("tr.priorityhighlighted td:nth-last-child(4)").text().trim();
        }

        function retrieveLvaHandbookUrl(html) {
            return html.find("div.contentcell>table>tbody>tr>td>a").attr('href');
        }

        function retrieveSlots(html) {
            const slotsTable = html.find("div.contentcell>table>tbody>tr>td>table>tbody>tr>td>table>tbody>tr>td>table>tbody tr");
            const totalLength = slotsTable.length;
            let slots = [];
            if (totalLength > 3) {
                slotsTable.each(function (i) {
                    // we just need every odd row
                    if (i % 2 != 0 && i != totalLength - 1) {
                        // get 2nd td-element, which is the date
                        const dateString = $(this).find('td').eq(1).text().trim();
                        // get 3rd td-element which is the time
                        const timeString = $(this).find('td').eq(2).text().trim();
                        if (dateString && timeString) {
                            slots.push(getStartEndTimes(dateString, timeString));
                        }
                    }
                });
            }
            return slots;
        }

        /**
         * Returns the object, which specifies the start and end time of an event
         * Input date format: dd.mm.yy
         * Input time format: hh:mm
         * @param date
         * @param time
         */
        function getStartEndTimes(dateString, timeString) {
            const dateComponents = dateString.split('.');
            const timeComponents = timeString.split(' ');
            const year = '20' + dateComponents[2];
            const month = dateComponents[1];
            const day = dateComponents[0];
            const startTime = timeComponents[0];
            const endTime = timeComponents[2];
            return {
                start: createISODateString(year, month, day, startTime),
                end: createISODateString(year, month, day, endTime)
            }
        }

        /**
         * Creates an ISO date string with the provided components
         * @param year
         * @param month
         * @param day
         * @param time
         * @returns {string}
         */
        function createISODateString(year, month, day, time) {
            return year + '-' + month + '-' + day + 'T' + time + ':00Z';
        }

        function getProxyRequestUrl(url) {
            return '{{ route('proxy') }}?url=' + encodeURIComponent(url);
        }
    </script>
@endif


