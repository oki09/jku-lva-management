@extends('user.layouts.app')

@section('content')
    <div id="loader" class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const windowHeight = $(window).height();
            const navbarHeight = $('#navbarUserMenu').height();
            const footerHeight = $('footer').height();
            console.log(windowHeight + ' ' + navbarHeight + ' ' + footerHeight);
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                height: 600,
                timeZone: 'UTC',
                initialDate: '{{config('app.semesterStart')}}',
                lazyFetching: true,
                slotEventOverlap: true,
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '20:30:00',
                slotLabelInterval: '00:30',
                hiddenDays: [0],
                headerToolbar: {
                    right: 'timeGridWeek,dayGridMonth',
                    center: '',
                    left: 'prev,next'
                },
                initialView: 'timeGridWeek',
                themeSystem: 'bootstrap',
                locale: 'de',
                displayEventTime: true,
                events: {
                    url: '{{route('calendar.events')}}',
                    failure: function (error) {
                        console.error(error);
                    }
                },
                loading: function (isLoading) {
                    if (isLoading) {
                        $('#loader').show();
                    } else {
                        $('#loader').hide();
                    }
                },
                eventDidMount: function (info) {
                    if (isOverlapping(info.event)) {
                        info.event.setProp('borderColor', 'red');
                    }
                }
            });

            function isOverlapping(event) {
                const arr = calendar.getEvents();
                arr.forEach(function (item, index) {
                    if (item.id != event.id) {
                        if (event.end.getTime() >= item.start.getTime() && event.start.getTime() <= item.end.getTime()) return true;
                    }
                });
                return false;
            }

            calendar.render();
        });
    </script>
@endsection
