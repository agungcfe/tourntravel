<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'destinations' => Destination::count(),
            'packages' => Package::count(),
            'posts' => Post::count(),
            'inquiries_new' => Inquiry::where('status', 'new')->count(),
            'users' => User::count(),
        ];

        // Jumlah inquiry 6 bulan terakhir untuk grafik sederhana
        $chart = collect(range(5, 0))->map(function ($i) {
            $month = now()->startOfMonth()->subMonths($i);

            return [
                'label' => $month->translatedFormat('M'),
                'total' => Inquiry::whereBetween('created_at', [$month, $month->copy()->endOfMonth()])->count(),
            ];
        });

        return view('admin.dashboard', [
            'stats' => $stats,
            'chart' => $chart,
            'latestInquiries' => Inquiry::with('package')->latest()->take(5)->get(),
            'latestPosts' => Post::latest()->take(5)->get(),
        ]);
    }
}
