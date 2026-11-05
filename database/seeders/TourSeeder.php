<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Bali', 'province' => 'Bali',
                'short' => 'Pulau Dewata dengan pantai, pura, dan budaya yang memikat.',
                'packages' => [
                    ['Bali Explore Ubud & Kintamani', 4, 3, 3250000, 2950000, 'Ubud Monkey Forest, Tegallalang Rice Terrace, Kintamani'],
                    ['Bali Honeymoon Romantic Escape', 5, 4, 6750000, null, 'Private villa, candle light dinner, Nusa Penida'],
                ],
            ],
            [
                'name' => 'Labuan Bajo', 'province' => 'Nusa Tenggara Timur',
                'short' => 'Gerbang menuju Taman Nasional Komodo dan Pink Beach.',
                'packages' => [
                    ['Sailing Komodo 3D2N', 3, 2, 4500000, 3990000, 'Pulau Padar, Pink Beach, Pulau Komodo, Manta Point'],
                ],
            ],
            [
                'name' => 'Raja Ampat', 'province' => 'Papua Barat Daya',
                'short' => 'Surga bawah laut dengan biodiversitas terkaya di dunia.',
                'packages' => [
                    ['Raja Ampat Diving Paradise', 5, 4, 12500000, null, 'Piaynemo, Pasir Timbul, Arborek, Diving Cape Kri'],
                ],
            ],
            [
                'name' => 'Yogyakarta', 'province' => 'DI Yogyakarta',
                'short' => 'Kota budaya dengan Candi Borobudur dan Prambanan.',
                'packages' => [
                    ['Jogja Heritage Tour', 3, 2, 1850000, 1650000, 'Borobudur Sunrise, Prambanan, Keraton, Malioboro'],
                    ['Jogja Adventure Merapi & Pantai', 2, 1, 1250000, null, 'Lava Tour Merapi, Goa Pindul, Pantai Timang'],
                ],
            ],
            [
                'name' => 'Lombok', 'province' => 'Nusa Tenggara Barat',
                'short' => 'Pantai eksotis, Gili Trawangan, dan Gunung Rinjani.',
                'packages' => [
                    ['Lombok & Gili Island Hopping', 4, 3, 3150000, null, 'Gili Trawangan, Gili Meno, Pantai Pink, Desa Sade'],
                ],
            ],
            [
                'name' => 'Danau Toba', 'province' => 'Sumatera Utara',
                'short' => 'Danau vulkanik terbesar di Asia Tenggara dengan Pulau Samosir.',
                'packages' => [
                    ['Pesona Danau Toba & Samosir', 4, 3, 2750000, 2490000, 'Pulau Samosir, Tomok, Air Terjun Sipiso-piso, Parapat'],
                ],
            ],
            [
                'name' => 'Bromo', 'province' => 'Jawa Timur',
                'short' => 'Sunrise legendaris di kawah Gunung Bromo.',
                'packages' => [
                    ['Bromo Midnight Sunrise Tour', 2, 1, 950000, null, 'Penanjakan, Kawah Bromo, Pasir Berbisik, Bukit Teletubbies'],
                ],
            ],
            [
                'name' => 'Wakatobi', 'province' => 'Sulawesi Tenggara',
                'short' => 'Taman laut nasional dengan terumbu karang yang menawan.',
                'packages' => [
                    ['Wakatobi Marine Escape', 4, 3, 7850000, null, 'Snorkeling Hoga, Pulau Tomia, Desa Bajo Mola'],
                ],
            ],
        ];

        foreach ($data as $i => $item) {
            $seed = \Illuminate\Support\Str::slug($item['name']);

            $destination = Destination::create([
                'name' => $item['name'],
                'province' => $item['province'],
                'short_description' => $item['short'],
                'description' => "{$item['name']} merupakan salah satu destinasi favorit di Indonesia. {$item['short']} Nikmati pengalaman tak terlupakan bersama pemandu lokal kami yang ramah dan berpengalaman.",
                'image' => "https://picsum.photos/seed/{$seed}/1200/800",
                'is_featured' => $i < 6,
                'is_active' => true,
            ]);

            foreach ($item['packages'] as $j => [$title, $days, $nights, $price, $discount, $highlights]) {
                $itinerary = collect(range(1, $days))
                    ->map(fn ($d) => "Hari {$d}: " . ($d === 1 ? 'Penjemputan & check-in hotel' : ($d === $days ? 'Belanja oleh-oleh & kepulangan' : 'Eksplorasi ' . $highlights)))
                    ->implode("\n");

                $destination->packages()->create([
                    'title' => $title,
                    'duration_days' => $days,
                    'duration_nights' => $nights,
                    'price' => $price,
                    'discount_price' => $discount,
                    'max_people' => 15,
                    'short_description' => "Highlight: {$highlights}.",
                    'description' => "Paket {$title} dirancang untuk Anda yang ingin menikmati {$item['name']} secara maksimal. Highlight perjalanan: {$highlights}.",
                    'itinerary' => $itinerary,
                    'includes' => "Hotel bintang 3/4\nTransportasi AC selama tour\nMakan sesuai program\nTiket masuk objek wisata\nPemandu wisata lokal\nAir mineral",
                    'excludes' => "Tiket pesawat\nPengeluaran pribadi\nTips pemandu & driver",
                    'image' => "https://picsum.photos/seed/{$seed}-pkg{$j}/1200/800",
                    'rating' => [4.7, 4.8, 4.9, 5.0][($i + $j) % 4],
                    'is_featured' => $j === 0,
                    'is_active' => true,
                ]);
            }
        }
    }
}
