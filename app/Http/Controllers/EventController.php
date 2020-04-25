<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
     /**
     * Create a new order instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $event = new Event;
        $request->validate([
            'name' => 'required|string',
            'event_date' => 'required|date',
        ]);
        $event->fill($request->input())->save();
        $event->save();
        return response()->json([
            'message' => "Successfully created event!"
        ], 200);
    }

    /**
     * Create a bulk event instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function bulk(Request $request)
    {
        Event::truncate();
        foreach($request["events"] as $key => $row) {
            $this->create(new Request($row));
        }
        return response()->json([
            'message' => "Successfully created events!",
        ], 200);
    }

    /**
     * Fetches events
     *
     * @param  [string] page
     * @param  [string] per_page
     * @return [string] message
     */
    public function events(Request $request)
    {
        $events = Event::all();
        return response()->json([
            'message' => "Successfully fetched events",
            'meta' => $events
        ], 200);
    }

}
