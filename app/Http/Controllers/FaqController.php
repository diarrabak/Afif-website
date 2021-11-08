<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::get();
        return view('faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faqs.create')
            ->with('faq', (new Faq()));
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
        $validatedFaq = $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required','string'],
        ]);

        $faq = Faq::create([
            'question' => $validatedFaq['question'],
            'answer' => $validatedFaq['answer'],
        ]); //Faq::create($request->input());
        $faq->save();
        return redirect()->action([FaqController::class, 'index']); //Redirect to the index page
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('faqs.edit')
            ->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //Transfer the form data to the current role

        $validatedFaq = $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        $faq->fill(array(
            'question' => $validatedFaq['question'],
            'answer' => $validatedFaq['answer'],
        ));
        // $faq->fill($request->input());
        //Save the user and go to index page
        $faq->save();

        return redirect()->action([FaqController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        Faq::where('id', $faq->id)->delete();
        return redirect()->action([FaqController::class, 'index']);
    }
}
