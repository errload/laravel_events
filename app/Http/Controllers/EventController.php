<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function getEvent($id)
    {
        $event = Event::find($id);
        $users = $event->users;

        return view('adminlte', [
            'event' => $event,
            'users' => $users
        ]);
    }

    public function applyEvent($id)
    {
        $event = Event::find($id);
        $event->users()->attach(Auth::id());

        return redirect()->route('get_event', $id);
    }

    public function cancelEvent($id)
    {
        $event = Event::find($id);
        $event->users()->detach(Auth::id());

        return redirect()->route('get_event', $id);
    }
}
