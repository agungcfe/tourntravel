<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Rina Kartika', 'Jakarta', 'Trip ke Labuan Bajo luar biasa! Kapalnya nyaman, guide-nya ramah dan sangat informatif. Pasti ikut lagi.'],
            ['Budi Santoso', 'Surabaya', 'Paket Jogja Heritage sangat worth it. Itinerary rapi dan hotelnya strategis dekat Malioboro.'],
            ['Dewi Lestari', 'Bandung', 'Honeymoon ke Bali jadi sangat berkesan. Semua diatur dengan detail, kami tinggal menikmati.'],
            ['Andi Pratama', 'Makassar', 'Pelayanan cepat dan responsif via WhatsApp. Harga transparan tanpa biaya tersembunyi.'],
        ];

        foreach ($items as [$name, $origin, $message]) {
            Testimonial::create(['name' => $name, 'origin' => $origin, 'message' => $message, 'rating' => 5, 'is_active' => true]);
        }
    }
}
