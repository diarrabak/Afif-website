<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonials.create')
            ->with('testimonial', (new Testimonial()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation of all the fields of a user before registration
        $validatedVisitor = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($request->has('picture') && !empty($request->picture)) {
            $validatedImg = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $fileName = $validatedImg['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
            $validatedImg['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', 
        }

        //Use the validated inputs for registration in the database

        $testimonial = new Testimonial([  //Passing the form data to the user object
            "title" => $validatedVisitor['title'], //$request->get('title'),
            "comment" => $validatedVisitor['comment'], //$request->get('biography'),
            "name" => $validatedVisitor['name'], //$request->get('name'),
            "picture" => $request->has('picture') ?  $fileName : '',
        ]);

        $testimonial->save(); // Finally, save the record.

        return redirect()->action([TestimonialController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit')
            ->with('testimonial', $testimonial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //Validate all the required field as at the creation
        $validatedVisitor = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        //Validate the picture field only if it is not empty. Use the saved picture otherwise
        if ($request->has('picture') && !empty($request->picture)) {
            $validatedImg = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $fileName = $validatedImg['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
            $validatedImg['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', 
        }

        $testimonial->fill(array(
            "title" => $validatedVisitor['title'], //$request->get('title'),
            "comment" => $validatedVisitor['comment'], //$request->get('biography'),
            "name" => $validatedVisitor['name'], //$request->get('name'),
            "picture" => $request->has('picture') ?  $fileName : $testimonial->picture,
        ));

        $testimonial->save();
        return redirect()->action([TestimonialController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        Testimonial::where('id', $testimonial->id)->delete();
        return redirect()->action([TestimonialController::class, 'index']);
    }
}
