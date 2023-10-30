<?php

namespace App\Http\Controllers\Client;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventImageController extends Controller
{
    public function destroy($id)
    {
        $id     = auth()->user()->id;
        $event  = Event::find($id);
        Storage::disk('upcloud')->delete('skapp/uploads/events/'.basename($event->photo));
        $event->photo = null;
        $event->save();

        return response()->json(200);
    }
}
