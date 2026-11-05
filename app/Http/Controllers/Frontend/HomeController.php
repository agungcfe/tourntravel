<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Post;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home', [
            'destinations' => Destination::active()->featured()->withCount('packages')->oldest()->take(5)->get(),
            'packages' => Package::active()->featured()->with('destination')->latest()->take(6)->get(),
            'testimonials' => Testimonial::active()->latest()->take(6)->get(),
            'posts' => Post::published()->with('category')->latest('published_at')->take(3)->get(),
            'allDestinations' => Destination::active()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function about()
    {
        return view('frontend.about');
    }
}
