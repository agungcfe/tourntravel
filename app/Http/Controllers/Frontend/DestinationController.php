<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::active()->withCount('packages')->orderBy('name')->paginate(9);

        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        abort_unless($destination->is_active, 404);

        $packages = $destination->packages()->active()->latest()->get();

        return view('frontend.destinations.show', compact('destination', 'packages'));
    }
}
