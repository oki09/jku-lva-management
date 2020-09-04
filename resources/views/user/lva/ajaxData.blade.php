@if(isset($lvaList))
    @if(count($lvaList) == 0)
        <p class="alert-danger">{{__('Course not found')}}</p>
    @else
        <p>{{count($lvaList) . ' ' . __('Results found')}}</p>
        <div style="height: 55vh" class="overflow-auto">
            <table class="table table-hover table-striped w-full table-sm">
                <thead>
                <th>Nr.</th>
                <th>Name</th>
                <th>ECTS</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($lvaList as $lva)
                    <tr>
                        <th id="lvaNr">{{$lva->lvaNr}}</th>
                        <td id="title">{{$lva->lvaName}}</td>
                        <td id="ects">{{$lva->lvaEcts}}</td>
                        <td id="lvaSlotsUrl" class="d-none">{{$lva->lvaSlotsUrl}}</td>
                        <td class="successHandler">
                            <button class="addLvaBtn btn btn-primary"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <script>
        $('.addLvaBtn').on('click', function () {
            const row = $(this).closest('tr');
            let slotsUrl = decodeURIComponent('{{ env('KUSSS_PREFIX')}}' + row.find('#lvaSlotsUrl').text());
            $.get({
                url: getProxyRequestUrl(slotsUrl),
                success(response) {
                    const parsedHtml = $($.parseHTML(response));
                    const slots = retrieveSlots(parsedHtml);
                    const capacity = retrieveLvaCapacity(parsedHtml);
                    storeSelectedLva(row, slots, capacity);
                },
                error(error) {
                    const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                    $('#successHandler').hide().html($data).fadeIn();
                }
            });
        });

        function storeSelectedLva(row, slots, capacity) {
            $.post({
                url: '{{route('lva.store')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify({
                    nr: row.find('#lvaNr').text(),
                    title: row.find('#title').text(),
                    ects: row.find('#ects').text(),
                    capacity: capacity,
                    slots: slots
                }),
                success() {
                    const addBtn = row.find('.successHandler');
                    const successBtn = $('<button class="btn btn-success"><i class="far fa-check-square"></i></button>');
                    addBtn.hide().html(successBtn).fadeIn();
                },
                error(error) {
                    const $data = '<p class="alert-danger">' + error.errorText + '</p>';
                    $('#successHandler').hide().html($data).fadeIn();
                }
            });
        }

        function retrieveLvaCapacity(html) {
            return html.find("tr.priorityhighlighted td:nth-child(6)").text().trim();
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


