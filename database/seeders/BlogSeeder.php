<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $tips = Category::create(['name' => 'Tips Traveling']);
        $guide = Category::create(['name' => 'Panduan Destinasi']);
        $kuliner = Category::create(['name' => 'Kuliner']);

        $author = User::where('role', User::ROLE_ADMIN)->first();

        $posts = [
            [$tips, '10 Tips Hemat Liburan ke Bali', 'Liburan ke Bali tidak harus mahal. Simak tips berikut agar perjalanan tetap seru dengan budget terkendali.'],
            [$guide, 'Panduan Lengkap Trip ke Labuan Bajo', 'Mulai dari waktu terbaik berkunjung hingga itinerary sailing trip yang wajib Anda coba.'],
            [$kuliner, '7 Kuliner Khas Yogyakarta yang Wajib Dicoba', 'Gudeg, bakpia, sate klathak, dan kuliner legendaris lain yang membuat Anda ingin kembali ke Jogja.'],
            [$tips, 'Barang Wajib Dibawa Saat Mendaki Bromo', 'Suhu di Bromo bisa mencapai 5°C saat dini hari. Persiapkan perlengkapan berikut agar tetap nyaman.'],
        ];

        foreach ($posts as $i => [$category, $title, $excerpt]) {
            Post::create([
                'category_id' => $category->id,
                'user_id' => $author?->id,
                'title' => $title,
                'excerpt' => $excerpt,
                'body' => "<p>{$excerpt}</p>\n<h2>Persiapan Sebelum Berangkat</h2>\n<p>Rencanakan perjalanan Anda jauh-jauh hari untuk mendapatkan harga tiket dan akomodasi terbaik. Pastikan juga Anda mengecek cuaca dan kondisi destinasi.</p>\n<h2>Selama Perjalanan</h2>\n<p>Hormati budaya dan adat setempat, jaga kebersihan lingkungan, dan dukung ekonomi lokal dengan membeli produk UMKM.</p>\n<p>Butuh bantuan merencanakan perjalanan? Tim Nusantara Trip siap membantu Anda!</p>",
                'image' => 'https://picsum.photos/seed/blog' . ($i + 1) . '/1200/800',
                'status' => Post::STATUS_PUBLISHED,
                'published_at' => now()->subDays(($i + 1) * 3),
            ]);
        }
    }
}
