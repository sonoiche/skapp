<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data['events'] = Event::where('date_from', '>=', $today)->orderBy('date_from')->get();
        return view('client.events.index', $data);
    }

    public function create()
    {
        return view('client.events.create');
    }

    public function store(EventRequest $request)
    {
        $datefield      = $request['schedule'];
        $schedule       = explode('-', $datefield);

        $event = new Event();
        $event->title       = $request['title'];
        $event->date_from   = Carbon::parse($schedule[0])->format('Y-m-d');
        $event->date_to     = Carbon::parse($schedule[1])->format('Y-m-d');
        $event->description = $request['description'];
        $event->event_goal  = $request['event_goal'];
        $event->location    = $request['location'];
        $event->user_id     = auth()->user()->id;
        
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('upcloud')->putFileAs(
                'skapp/uploads/events',
                $file,
                $photo,
                'public'
            );
            
            $event->photo = Storage::disk('upcloud')->url($path);
        }
        $event->save();

        return redirect()->to('client/events')->with('success', 'New event has been added.');
    }

    public function edit($id)
    {
        $data['event'] = Event::find($id);
        return view('client.events.edit', $data);
    }

    public function update(EventRequest $request, $id)
    {
        $datefield      = $request['schedule'];
        $schedule       = explode('-', $datefield);

        $event = Event::find($id);
        $event->title       = $request['title'];
        $event->date_from   = Carbon::parse($schedule[0])->format('Y-m-d');
        $event->date_to     = Carbon::parse($schedule[1])->format('Y-m-d');
        $event->description = $request['description'];
        $event->event_goal  = $request['event_goal'];
        $event->location    = $request['location'];
        
        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            $path = Storage::disk('upcloud')->putFileAs(
                'skapp/uploads/events',
                $file,
                $photo,
                'public'
            );
            
            $event->photo = Storage::disk('upcloud')->url($path);
        }
        $event->save();

        return redirect()->to('client/events')->with('success', 'Event has been updated.');
    }

    public function show($id)
    {
        $data['event'] = Event::find($id);
        return view('client.events.show', $data);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if(isset($event->photo)) {
            Storage::disk('upcloud')->delete('skapp/uploads/events/'.basename($event->photo));
        }
        $event->delete();

        return response()->json(200);
    }
}
