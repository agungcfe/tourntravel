<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Models\Destination;
use App\Models\Package;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(private ImageUploadService $images) {}

    public function index(Request $request)
    {
        $packages = Package::with('destination')
            ->when($request->q, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->destination, fn ($q, $d) => $q->where('destination_id', $d))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $destinations = Destination::orderBy('name')->get(['id', 'name']);

        return view('admin.packages.index', compact('packages', 'destinations'));
    }

    public function create()
    {
        return view('admin.packages.form', [
            'package' => new Package(['is_active' => true, 'duration_days' => 3, 'duration_nights' => 2, 'max_people' => 10, 'rating' => 5]),
            'destinations' => Destination::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(PackageRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->images->store($request->file('image'), 'packages');

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket tour berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.form', [
            'package' => $package,
            'destinations' => Destination::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(PackageRequest $request, Package $package)
    {
        $data = $request->validated();
        $data['image'] = $this->images->store($request->file('image'), 'packages', $package->image);

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket tour berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $this->images->delete($package->image);
        $package->delete();

        return back()->with('success', 'Paket tour berhasil dihapus.');
    }
}
