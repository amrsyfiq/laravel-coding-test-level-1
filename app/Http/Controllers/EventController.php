<?php

namespace App\Http\Controllers;

// Author : Muhammad Amir Syafiq

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->simplePaginate(5)->appends(request()->query());
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:events|max:255',
                'startAt' => 'required|before_or_equal:endAt',
                'endAt' => 'required|after_or_equal:startAt'
            ],
            [
                'startAt.before_or_equal' => 'Start datetime must be before or equal to End datetime',
                'endAt.after_or_equal' => 'End datetime must be after  or equal to Start datetime'
            ]
        );

        $event = new Event();

        $event->name = $request->name;
        $event->slug = str_slug($request->name, '-');
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->updated_at = now();
        $event->save();

        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate(
            [
                'startAt' => 'required|before_or_equal:endAt',
                'endAt' => 'required|after_or_equal:startAt'
            ],
            [
                'startAt.before_or_equal' => 'Start datetime must be before or equal to End datetime',
                'endAt.after_or_equal' => 'End datetime must be after  or equal to Start datetime'
            ]
        );

        $event->name = $request->name;
        $event->slug = str_slug($request->name, '-');
        $event->startAt = $request->startAt;
        $event->endAt = $request->endAt;
        $event->updated_at = now();
        $event->save();

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();
        return redirect()->route('event.index');
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $events = Event::where('name', 'LIKE', "%{$search}%")->simplePaginate(5)->appends(request()->query());

        return view('events.index', compact('events'));
    }
}
