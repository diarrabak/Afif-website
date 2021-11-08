<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create')
            ->with('service', (new Service()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedService = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);


        $fileName = $validatedService['picture']->getClientOriginalName();

        $validatedService['picture']->storeAs('images', $fileName, 'public');

        $service = Service::create([
            'title' => $validatedService['title'],
            'description' =>  $validatedService['description'],
            "picture" => $fileName,
        ]);

        $service->save();
        return redirect()->action([ServiceController::class, 'index']); //Redirect to the index page
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validatedService = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        //Validate the picture field only if it is not empty. Use the saved picture otherwise
        if ($request->has('picture') && !empty($request->picture)) {
            $validatedImg = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $fileName = $validatedImg['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
            $validatedImg['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', 
        }

        //Transfer the form data to the current service
        // $service->fill($request->input());
        $service->fill(array(
            'title' => $validatedService['title'],
            'description' =>  $validatedService['description'],
            "picture" => $request->has('picture') ?  $fileName : $service->picture,
        ));
        //Save the service and go to index page
        $service->save();

        return redirect()->action([ServiceController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->action([ServiceController::class, 'index']);
    }
}
