<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::setMany([
            'site_name' => 'Nusantara Trip',
            'site_tagline' => 'Jelajahi Keindahan Indonesia',
            'hero_title' => 'Jelajahi Pesona Nusantara Bersama Kami',
            'hero_subtitle' => 'Paket tour terbaik ke Bali, Labuan Bajo, Raja Ampat, Yogyakarta, dan ratusan destinasi menakjubkan lainnya.',
            'hero_image' => 'https://picsum.photos/seed/nusantara-hero/1920/1080',
            'about_text' => "Nusantara Trip adalah agen tour & travel yang berdiri sejak 2015 dan telah melayani lebih dari 25.000 wisatawan. Kami percaya setiap perjalanan adalah cerita, dan kami hadir untuk memastikan cerita Anda tak terlupakan.\n\nDengan pemandu lokal berpengalaman, armada yang nyaman, dan harga transparan, kami siap mengantar Anda menjelajahi keindahan Indonesia dari Sabang sampai Merauke.",
            'contact_email' => 'halo@nusantaratrip.id',
            'contact_phone' => '(021) 555-0123',
            'contact_whatsapp' => '6281234567890',
            'contact_address' => 'Jl. Sudirman No. 45, Jakarta Pusat, DKI Jakarta 10220',
            'social_instagram' => 'https://instagram.com/',
            'social_facebook' => 'https://facebook.com/',
            'social_tiktok' => 'https://tiktok.com/',
        ]);
    }
}
