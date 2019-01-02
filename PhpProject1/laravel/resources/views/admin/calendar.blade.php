@extends('layouts.app')


@section('content')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>

    <h2 class="page-title" style="margin-bottom: 0 !important;">Calendar</h2>

    <div id='calendar'></div>

@endsection

@section('javascript')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events)  !!};
            $('#calendar').fullCalendar({
                buttonText: {
                    today: 'Oggi',
                    month: 'Mese',
                    week: 'Settimana',
                    day: 'Giorno'
                },
                events: events,
                 locale: 'it'
            }); 
            
            $('.fc-scroller.fc-day-grid-container').css('height', '470px');
            $('.fc-next-button').click(function(){
                $('.fc-scroller.fc-day-grid-container').css('height', '470px');
            });
            $('.fc-today-button').click(function(){
                $('.fc-scroller.fc-day-grid-container').css('height', '470px');
            });
            $('.fc-prev-button').click(function(){
                $('.fc-scroller.fc-day-grid-container').css('height', '470px');
            });
        });
    </script>
@endsection