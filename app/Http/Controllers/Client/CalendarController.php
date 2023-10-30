<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events         = Event::all();
        $event_array    = [];
        foreach ($events as $event) {
            $event_array[] = [
                'id'        => $event->id,
                'title'     => $event->title,
                'start'     => $event->date_from,
                'end'       => $event->date_to,
                'allDay'    => ($event->date_from == $event->Date_to),
                'url'       => url('client/events', $event->id)
            ];
        }

        $data['events'] = $event_array;
        return view('client.events.calendar', $data);
    }
}
