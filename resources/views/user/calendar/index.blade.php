@extends('user.layouts.app')

@section('content')
    <div id="calendar"></div>

    <script>
        let myPopover;
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            let isMobile = window.matchMedia("only screen and (max-width: 600px)").matches;
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
                height: '100vh',
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '21:00:00',
                slotLabelInterval: '00:30',
                hiddenDays: [0],
                headerToolbar: {
                    right: 'timeGridWeek,dayGridMonth listMonth',
                    center: 'title',
                    left: 'prev,next'
                },
                listDayFormat: {
                    month: 'long',
                    day: 'numeric',
                    weekday: 'short',
                    year: 'numeric'
                },
                listDaySideFormat: false,
                initialView: 'timeGridWeek',
                themeSystem: 'bootstrap',
                displayEventTime: true,
                loading: function (isLoading) {
                    if (isLoading) {
                        $('#loader').show();
                    } else {
                        $('#loader').hide();
                    }
                },
                eventClick: function (info) {
                    const $html = $(info.el);
                    // init popover
                    $html.popover({
                        title: info.event.title,
                        placement: 'top',
                        container: 'body',
                        trigger: 'click',
                        content: 'LVA-Nr: ' + info.event.extendedProps.nr
                    });
                },
                eventDidMount: function (info) {
                    if (isOverlapping(info.event, calendar.getEvents())) {
                        info.event.setProp('color', 'red');
                    }
                    info.event.title = 'test';
                    $('button.fc-listMonth-button').html('<i class="fa fa-bars"></i>');
                }
            });

            const lang = $('html').prop('lang');
            calendar.setOption('locale', lang);

            calendar.render();

            $('button.fc-listMonth-button').html('<i class="fa fa-bars"></i>');

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
                            return true;
                        }
                        // check if eventToCheck is between an event
                        if (moment(eventToCheck.end).isSameOrAfter(events[i].start) && moment(eventToCheck.end).isSameOrBefore(events[i].end)) {
                            return true;
                        }
                        // check if eventToCheck is between an event
                        if (moment(eventToCheck.start).isSameOrAfter(events[i].start) && moment(eventToCheck.end).isSameOrBefore(events[i].end)) {
                            return true;
                        }
                    }
                }
                return false;
            }
        });
    </script>
@endsection
