@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
@php $s = fn ($key) => old($key, $settings[$key] ?? ''); @endphp
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-layout">
        <div class="stack">
            <div class="panel">
                <h3 class="panel-title">Identitas Website</h3>
                <div class="grid-2">
                    <label class="field"><span>Nama Website *</span><input class="input" name="site_name" value="{{ $s('site_name') }}" required></label>
                    <label class="field"><span>Tagline</span><input class="input" name="site_tagline" value="{{ $s('site_tagline') }}"></label>
                </div>
                <label class="field"><span>Tentang Kami</span><textarea class="input" name="about_text" rows="6">{{ $s('about_text') }}</textarea></label>
            </div>
            <div class="panel">
                <h3 class="panel-title">Hero Beranda</h3>
                <label class="field"><span>Judul Hero</span><input class="input" name="hero_title" value="{{ $s('hero_title') }}"></label>
                <label class="field"><span>Sub Judul Hero</span><textarea class="input" name="hero_subtitle" rows="2">{{ $s('hero_subtitle') }}</textarea></label>
                @include('admin.partials.image-input', ['name' => 'hero_image', 'current' => media_url($settings['hero_image'] ?? null) ?: null, 'label' => 'Gambar Hero'])
            </div>
        </div>
        <div class="stack">
            <div class="panel">
                <h3 class="panel-title">Kontak</h3>
                <label class="field"><span>Email</span><input class="input" type="email" name="contact_email" value="{{ $s('contact_email') }}"></label>
                <label class="field"><span>Telepon</span><input class="input" name="contact_phone" value="{{ $s('contact_phone') }}"></label>
                <label class="field"><span>WhatsApp <small>(format 628xxx)</small></span><input class="input" name="contact_whatsapp" value="{{ $s('contact_whatsapp') }}"></label>
                <label class="field"><span>Alamat</span><textarea class="input" name="contact_address" rows="2">{{ $s('contact_address') }}</textarea></label>
            </div>
            <div class="panel">
                <h3 class="panel-title">Sosial Media</h3>
                <label class="field"><span>Instagram</span><input class="input" type="url" name="social_instagram" value="{{ $s('social_instagram') }}"></label>
                <label class="field"><span>Facebook</span><input class="input" type="url" name="social_facebook" value="{{ $s('social_facebook') }}"></label>
                <label class="field"><span>TikTok</span><input class="input" type="url" name="social_tiktok" value="{{ $s('social_tiktok') }}"></label>
                <button class="btn btn-primary btn-block">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
</form>
@endsection
