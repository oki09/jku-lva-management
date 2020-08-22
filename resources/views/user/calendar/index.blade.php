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
                height: 700,
                timeZone: 'UTC',
                initialDate: '{{config('app.semesterStart')}}',
                lazyFetching: true,
                slotEventOverlap: true,
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
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
                eventLimit: true,
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
                }
            });
            calendar.render();
        });
    </script>
@endsection
