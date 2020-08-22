@if(isset($lvaData))
    @if(empty($lvaData['lvaNr']))
        <p class="alert-danger">Kurs konnte nicht gefunden werden</p>
    @else
        <table class="table table-hover table-striped w-full table-sm">
            <thead>
            <th>Nr.</th>
            <th>Name</th>
            <th>ECTS</th>
            <th></th>
            </thead>
            <tbody>
            <tr>
                <th>{{$lvaData['lvaNr']}}</th>
                <td>{{$lvaData['lvaName']}}</td>
                <td>{{$lvaData['lvaEcts']}}</td>
                <td>
                    <button id="addLvaBtn" class="btn btn-outline-primary"><i class="fas fa-plus"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
    @endif
    <script>
        $('#addLvaBtn').on('click', function () {
            let slotsUrl = '{{ env('KUSSS_PREFIX') . $lvaData['lvaSlotsUrl']}}';
            slotsUrl = slotsUrl.replaceAll('&amp;', '&');
            $.get({
                url: getProxyRequestUrl(slotsUrl),
                success(response) {
                    const html = $($.parseHTML(response));
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
                    $.post({
                        url: '{{route('lva.store')}}',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: JSON.stringify({
                            nr: '{{$lvaData['lvaNr']}}',
                            title: '{{$lvaData['lvaName']}}',
                            ects: '{{$lvaData['lvaEcts']}}',
                            slots: slots
                        }),
                        success() {
                            window.location.href = '{{route('lva.index')}}';
                        },
                        error(error) {
                            console.log(error);
                            console.log("Adding failed");
                        }
                    });
                },
                error(error) {
                    console.log(error);
                }
            });
        });

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


