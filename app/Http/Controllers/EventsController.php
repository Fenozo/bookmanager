<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateEventFormRequest;

use Illuminate\Support\Facades\DB;
use App\Model\Event;
use Flashy;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $events = Event::orderBy('id','desc')->Paginate(3);
        $counts = Event::count();
        // dump($counts);
        // $events = Event::where('id', '>', 0)->orderBy('id','desc')->paginate(3);
        
        return view('events.index', compact('events', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event;
        return view('events.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventFormRequest $request)
    {
        Event::create([
            'title' => $request->title,
            'description' => $request->description,

        ]);
        
        Flashy::message("L'événement est créer avec succé");

        return redirect()->route('root_web');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // $event = Event::whereId($id)->firstOrFail();

        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        // $event = Event::whereId($id)->firstOrFail();

        return view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEventFormRequest $request, Event $event)
    {
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
      
        ]);

        flashy()->primary(sprintf("L'événement  #%s a été modifié avec succé", $event->id));


        return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        Flashy::error(sprintf("L'événement #%s a été supprimé avec succé", $event->id));

        return redirect()->route('events.index');
    }
}
