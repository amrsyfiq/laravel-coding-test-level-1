<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Return all events from the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return Event::all()->isEmpty() ? 'No event' : Event::all();
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * Return all events that are active = current datetime is within startAt and endAt.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeEvent()
    {
        try {
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $events = Event::where('startAt', '<=', $now)
                ->where('endAt', '>=', $now)
                ->get();
            return $events->isEmpty() ? 'No active event' : $events;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * Get one event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $event = Event::find($id);
            return $event ? $event : 'No event';
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * Create an event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            request()->validate([
                'name' => 'required',
                'startAt' => ['required', 'date_format:Y-m-d H:i:s'],
                'endAt' => ['required', 'date_format:Y-m-d H:i:s']
            ]);
            return Event::create([
                'name' => $request->name,
                'startAt' => $request->startAt,
                'endAt' => $request->endAt
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * Create event if not exist, else update the event in idempotent way.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            request()->validate([
                'name' => 'required',
                'startAt' => 'date_format:Y-m-d H:i:s',
                'endAt' => 'date_format:Y-m-d H:i:s'
            ]);
            $event = Event::updateOrCreate(
                ['id' =>  $id],
                [
                    'name' =>  $request->name,
                    'startAt' => $request->startAt,
                    'endAt' => $request->endAt
                ]
            );
            return $event ? $event : 'No Event';
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * Partially update event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patch(Request $request, $id)
    {
        try {
            $event = Event::findOrfail($id);
            if ($request->name) {
                $event->name = $request->name;
            }

            if ($request->startAt) {
                $event->startAt = $request->startAt;
            }

            if ($request->endAt) {
                $event->endAt = $request->endAt;
            }
            $event->save();
            return $event ? $event : 'No Event';
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }

    /**
     * Soft delete an event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $event = Event::findOrfail($id);
            $success = $event->delete();
            return ['success' => $success];
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \Exception('Error');
        }
    }
}
