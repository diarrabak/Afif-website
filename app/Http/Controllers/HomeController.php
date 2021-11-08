<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Event;
use App\Models\Testimonial;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events=Event::where('date','>=', date('Y-m-d'))->get();
        $services=Service::get();
        $testimonials=Testimonial::get();
        return view('home')
        ->with('events',$events)
        ->with('services',$services)
        ->with('testimonials',$testimonials); 
    }
}
