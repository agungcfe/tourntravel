<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

/** Pengaturan konten umum website: identitas, kontak, hero, sosial media. */
class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings', ['settings' => Setting::allCached()]);
    }

    public function update(Request $request, ImageUploadService $images)
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:100'],
            'site_tagline' => ['nullable', 'string', 'max:200'],
            'hero_title' => ['nullable', 'string', 'max:200'],
            'hero_subtitle' => ['nullable', 'string', 'max:300'],
            'hero_image' => ['nullable', 'image', 'max:3072'],
            'about_text' => ['nullable', 'string'],
            'contact_email' => ['nullable', 'email'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'contact_whatsapp' => ['nullable', 'string', 'max:30'],
            'contact_address' => ['nullable', 'string', 'max:300'],
            'social_instagram' => ['nullable', 'url'],
            'social_facebook' => ['nullable', 'url'],
            'social_tiktok' => ['nullable', 'url'],
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $images->store($request->file('hero_image'), 'settings', Setting::get('hero_image'));
        } else {
            unset($data['hero_image']);
        }

        Setting::setMany($data);

        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
