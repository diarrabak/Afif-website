<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Gallery::where('type', 'Image')->get();
        $videos = Gallery::where('type', 'Video')->get();
        $audios = Gallery::where('type', 'Audio')->get();
        // dd($images);
        return view('galleries.index', compact('images', 'videos','audios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create')
            ->with('gallery', (new Gallery()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->get('type');

        $validatedGallery = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'link' => ['required', 'string', 'max:255'],
        ]);

        $validatedImg = "";

        if (strtolower($type) == 'image') {

            $validatedImg = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
        } else if (strtolower($type) == 'video') {
            $validatedImg = $request->validate([
                'picture' => "required | mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,ogg,x-msvideo,x-ms-wmv |max:9000000",
            ]);
        } else {
            $validatedImg = $request->validate([
                'picture' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav,ogg',
            ]);
        }


        $fileName = $validatedImg['picture']->getClientOriginalName();

        $validatedImg['picture']->storeAs('images', $fileName, 'public');

        $gallery = Gallery::create([
            'title' => $validatedGallery['title'],
            'author' => $validatedGallery['author'],
            'type' =>  $validatedGallery['type'],
            'description' =>  $validatedGallery['description'],
            "picture" => $fileName,
            'link' =>  $validatedGallery['link'],
        ]);

        $gallery->save();
        return redirect()->action([GalleryController::class, 'index']); //Redirect to the index page
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {

        $type = $request->get('type');

        $validatedGallery = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'link' => ['required', 'string', 'max:255'],
        ]);

        //Validate the picture field only if it is not empty. Use the saved picture otherwise
        if ($request->has('picture') && !empty($request->picture)) {
           
            //Each one of the three cases
            $validatedImg = "";

            if (strtolower($type) == 'image') {

                $validatedImg = $request->validate([
                    'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                ]);
            } else if (strtolower($type) == 'video') {
                $validatedImg = $request->validate([
                    'picture' => "required | mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,ogg,x-msvideo,x-ms-wmv |max:9000000",
                ]);
            } else {
                $validatedImg = $request->validate([
                    'picture' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav,ogg',
                ]);
            }

            $fileName = $validatedImg['picture']->getClientOriginalName(); //$request->picture->getClientOriginalName();
            $validatedImg['picture']->storeAs('images', $fileName, 'public');  //$request->picture->storeAs('images', 
        }

        //Transfer the form data to the current gallery
        // $gallery->fill($request->input());
        $gallery->fill(array(
            'title' => $validatedGallery['title'],
            'author' => $validatedGallery['author'],
            'type' => $validatedGallery['type'],
            'description' =>  $validatedGallery['description'],
            "picture" => $request->has('picture') ?  $fileName : $gallery->picture,
            'link' =>  $validatedGallery['link'],
        ));
        //Save the gallery and go to index page
        $gallery->save();

        return redirect()->action([GalleryController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->action([GalleryController::class, 'index']);
    }
}
