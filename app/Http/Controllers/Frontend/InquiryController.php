<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

/** Halaman kontak & penyimpanan form booking dari pengunjung. */
class InquiryController extends Controller
{
    public function create()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'package_id' => ['nullable', 'exists:packages,id'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'travel_date' => ['nullable', 'date', 'after_or_equal:today'],
            'participants' => ['nullable', 'integer', 'min:1', 'max:500'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        Inquiry::create($data);

        return back()->with('success', 'Terima kasih! Tim kami akan segera menghubungi Anda.');
    }
}
