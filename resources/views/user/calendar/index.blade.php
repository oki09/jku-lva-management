@extends('user.layouts.app')

@section('content')
    <div id="calendar"></div>
    <button class="btn btn-primary" id="toTheTopBtn">
        <i class="fas fa-chevron-up"></i>
    </button>
    <script>
        let myPopover;
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            let isMobile = window.matchMedia("only screen and (max-width: 600px)").matches;
            const calendar = new FullCalendar.Calendar(calendarEl, {
                events: {
                    url: '{{route('calendar.events')}}',
                    failure: function (error) {
                        $('#calendar').html('<p class="alert-danger text-center">{{__('An error occurred, while loading the data. Please consult the admin.')}}</p>').show();
                        console.error(error);
                    }
                },
                eventDisplay: 'block',
                headerToolbar: {
                    right: isMobile ? 'dayGridMonth listMonth' : 'timeGridWeek,dayGridMonth listMonth',
                    center: 'title',
                    left: 'prev,next'
                },
                views: {
                    dayGridMonth: {
                        displayEventTime: false
                    },
                    listMonth: {
                        listDayFormat: {
                            month: 'long',
                            day: 'numeric',
                            weekday: 'short',
                            year: 'numeric'
                        },
                        listDaySideFormat: false
                    },
                    timeGridWeek: {
                        displayEventTime: true,
                        slotMinTime: '08:00:00',
                        slotMaxTime: '21:00:00',
                        slotLabelInterval: '02:00',
                        slotEventOverlap: false
                    }
                },
                timeZone: 'UTC',
                initialDate: '{{env('CALENDAR_START_DATE')}}',
                lazyFetching: true,
                expandRows: true,
                contentHeight: '90vh',
                allDaySlot: false,
                hiddenDays: [0], // hide sundays
                initialView: isMobile ? 'listMonth' : 'timeGridWeek',
                themeSystem: 'bootstrap',
                loading: function (isLoading) {
                    if (isLoading) {
                        $('#loader').show();
                    } else {
                        $('#loader').hide();
                    }
                },
                eventDidMount: function (info) {
                    /*if (isOverlapping(info.event, calendar.getEvents())) {
                        info.event.setProp('color', 'red');
                    }*/
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
    <script src="{{ asset('js/scrollToTop.js') }}"></script>
@endsection
