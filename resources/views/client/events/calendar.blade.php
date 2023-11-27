@extends('layouts.app', ['page' => ['name' => 'Events Calendar']])
@section('content')
<div class="d-flex justify-content-end my-3">
    @if (auth()->user()->role == 'Admin')
    <a href="{{ url('client/events/create') }}" class="btn btn-primary">Add New Event</a>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('vendor/fullcalendar/calendar.css') }}">
<style>
.fc-event-container > a {
    text-decoration: none !important;
}

.fc-event-time {
    display: none;
}
.fc-event-title {
    padding-left: 10px;
}
    
#external-events {
    float: left;
    width: 150px;
    padding: 0 10px;
    text-align: left;
}
    
#external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
}
    
.external-event { /* try to mimick the look of a real event */
    margin: 10px 0;
    padding: 2px 4px;
    background: #3366CC;
    color: #fff;
    font-size: .85em;
    cursor: pointer;
}
    
#external-events p {
    margin: 1.5em 0;
    font-size: 11px;
    color: #666;
}
    
#external-events p input {
    margin: 0;
    vertical-align: middle;
}

#calendar {
    margin: 0 auto;
    width: 900px;
    background-color: #FFFFFF;
    border-radius: 6px;
    box-shadow: 0 1px 2px #C3C3C3;
    -webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
    -moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
    box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
}

</style>
@endsection

@section('page-js')
<script src="{{ url('vendor/fullcalendar/calendar.js') }}"></script>
<script>
$(document).ready(function() {
    /* initialize the calendar */
    var calendar =  $('#calendar').fullCalendar({
        header: {
            left: 'title',
            center: 'month', // agendaDay,agendaWeek,
            right: 'prev,next today'
        },
        editable: false,
        firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: false,
        defaultView: 'month',
        displayEventTime: false,
        axisFormat: 'h:mm',
        columnFormat: {
            month: 'ddd',       // Mon
            week: 'ddd d',      // Mon 7
            day: 'dddd M/d',    // Monday 9/7
            agendaDay: 'dddd d'
        },
        titleFormat: {
            month: 'MMMM yyyy',     // September 2009
            week: "MMMM yyyy",      // September 2009
            day: 'MMMM yyyy'        // Tuesday, Sep 8, 2009
        },
        allDaySlot: false,
        selectHelper: true,
        events: <?php echo json_encode($events); ?>		
    });
});

</script>
@endsection