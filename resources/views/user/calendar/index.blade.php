@extends('user.layouts.app')

@section('content')
    <div id="loader" class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                events: {
                    url: '{{route('calendar.events')}}',
                    failure: function (error) {
                        console.error(error);
                    }
                },
                timeZone: 'UTC',
                initialDate: '{{config('app.semesterStart')}}',
                lazyFetching: true,
                slotEventOverlap: true,
                expandRows: true,
                height: '100%',
                contentHeight: '100%',
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '21:00:00',
                slotLabelInterval: '00:30',
                hiddenDays: [0],
                headerToolbar: {
                    right: 'timeGridWeek,dayGridMonth',
                    center: '',
                    left: 'prev,next'
                },
                initialView: 'timeGridWeek',
                themeSystem: 'bootstrap',
                locale: 'en',
                displayEventTime: false,
                loading: function (isLoading) {
                    if (isLoading) {
                        $('#loader').show();
                    } else {
                        $('#loader').hide();
                    }
                },
                eventDidMount: function (info) {
                    if (isOverlapping(info.event, calendar.getEvents())) {
                        info.event.setProp('borderColor', 'red');
                    }
                }
            });

            const lang = $('html').prop('lang');
            calendar.setOption('locale', lang);

            calendar.render();

            /***
             * This method checks if the eventToCheck is overlapping with any of the events in the events array.
             * @param eventToCheck
             * @param events
             * @returns {boolean}
             */
            function isOverlapping(eventToCheck, events) {
                for (let i = 0; i < events.length; i++) {
                    // check if not the same event
                    if (eventToCheck.id != events[i].id) {
                        // check if eventToCheck is between an event
                        if (moment(eventToCheck.start).isSameOrAfter(events[i].start) && moment(eventToCheck.start).isSameOrBefore(events[i].end)) {
                            console.log("intersection between " + eventToCheck.title + ' and ' + events[i].title);
                            return true;
                        }
                        // check if eventToCheck is between an event
                        if (moment(eventToCheck.end).isSameOrAfter(events[i].start) && moment(eventToCheck.end).isSameOrBefore(events[i].end)) {
                            console.log("intersection between " + eventToCheck.title + ' and ' + events[i].title);
                            return true;
                        }
                        // check if eventToCheck is between an event
                        if (moment(eventToCheck.start).isSameOrAfter(events[i].start) && moment(eventToCheck.end).isSameOrBefore(events[i].end)) {
                            console.log("intersection between " + eventToCheck.title + ' and ' + events[i].title);
                            return true;
                        }
                    }
                }
                return false;
            }
        });
    </script>
@endsection
