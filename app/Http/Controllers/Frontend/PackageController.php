<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::active()
            ->with('destination')
            ->when($request->filled('q'), fn ($q) => $q->where('title', 'like', '%' . $request->q . '%'))
            ->when($request->filled('destination'), fn ($q) => $q->where('destination_id', $request->destination))
            ->when($request->sort === 'price_asc', fn ($q) => $q->orderByRaw('COALESCE(discount_price, price) asc'))
            ->when($request->sort === 'price_desc', fn ($q) => $q->orderByRaw('COALESCE(discount_price, price) desc'))
            ->when(! $request->filled('sort'), fn ($q) => $q->latest())
            ->paginate(9)
            ->withQueryString();

        $destinations = Destination::active()->orderBy('name')->get(['id', 'name']);

        return view('frontend.packages.index', compact('packages', 'destinations'));
    }

    public function show(Package $package)
    {
        abort_unless($package->is_active, 404);

        $package->load('destination');

        $related = Package::active()
            ->where('destination_id', $package->destination_id)
            ->whereKeyNot($package->id)
            ->take(3)->get();

        return view('frontend.packages.show', compact('package', 'related'));
    }
}
