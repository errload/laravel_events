<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        $event = Event::create($request);

        if ($event) return response()->json([
            'error' => null,
            'result' => [
                'id' => $event->id,
                'title' => $event->title,
                'text' => $event->text
            ]
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function getList()
    {
        $events = Event::all();

        foreach ($events as $event) {
            $results[] = [
                'id' => $event->id,
                'title' => $event->title,
                'text' => $event->text
            ];
        }

        return response()->json([
            'error' => null,
            'result' => $results
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function applyEvent($id)
    {
        $event = Event::find($id);
        $event->users()->attach(Auth::id());
    }

    public function cancelEvent($id)
    {
        $event = Event::find($id);
        $event->users()->detach(Auth::id());
    }

    public function delete($id)
    {
        $event = Event::find($id);
        if ($event->user_id === Auth::id()) $event->delete();
    }
}
