<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pastEvents = Event::where('date','<', date('Y-m-d'))->get();
        $futureEvents = Event::where('date','>=', date('Y-m-d'))->get();
        return view('events.index', compact('pastEvents','futureEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create')
            ->with('event', (new Event()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedEvent = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'place' => ['required', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'date' => ['required', 'date'],
        ]);


        $fileName = $validatedEvent['picture']->getClientOriginalName();

        $validatedEvent['picture']->storeAs('images', $fileName, 'public');

        $event = Event::create([
            'title' => $validatedEvent['title'],
            'author' => $validatedEvent['author'],
            'description' =>  $validatedEvent['description'],
            'place' =>  $validatedEvent['place'],
            'link' =>  $validatedEvent['link'],
            "picture" => $fileName,
            'date' => $validatedEvent['date'],
        ]);

        $event->save();
        return redirect()->action([EventController::class, 'index']); //Redirect to the index page
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validatedEvent = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'place' => ['required', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ]);

        //Validate the picture field only if it is not empty. Use the saved picture otherwise
        if ($request->has('picture') && !empty($request->picture)) {
            $validatedImg = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $fileName = $validatedImg['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
            $validatedImg['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', 
        }

        //Transfer the form data to the current event
        // $event->fill($request->input());
        $event->fill(array(
            'title' => $validatedEvent['title'],
            'author' => $validatedEvent['author'],
            'description' =>  $validatedEvent['description'],
            'place' =>  $validatedEvent['place'],
            'link' =>  $validatedEvent['link'],
            "picture" => $request->has('picture') ?  $fileName : $event->picture,
            'date' => $validatedEvent['date'],
        ));
        //Save the event and go to index page
        $event->save();

        return redirect()->action([EventController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->action([EventController::class, 'index']);
    }
}
