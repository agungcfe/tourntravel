<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestinationRequest;
use App\Models\Destination;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function __construct(private ImageUploadService $images) {}

    public function index(Request $request)
    {
        $destinations = Destination::withCount('packages')
            ->when($request->q, fn ($q, $s) => $q->where('name', 'like', "%{$s}%")->orWhere('province', 'like', "%{$s}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.form', ['destination' => new Destination(['is_active' => true])]);
    }

    public function store(DestinationRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->images->store($request->file('image'), 'destinations');

        Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.form', compact('destination'));
    }

    public function update(DestinationRequest $request, Destination $destination)
    {
        $data = $request->validated();
        $data['image'] = $this->images->store($request->file('image'), 'destinations', $destination->image);

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destination $destination)
    {
        $this->images->delete($destination->image);
        $destination->delete();

        return back()->with('success', 'Destinasi berhasil dihapus.');
    }
}
