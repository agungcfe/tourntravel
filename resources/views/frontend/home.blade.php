@extends('layouts.frontend')

@section('title', 'Beranda')
@section('body_class', 'has-hero')

@section('content')
{{-- HERO --}}
<section class="hero" style="--cover: url('{{ media_url(setting('hero_image'), 'https://picsum.photos/seed/nusantara-hero/1920/1080') }}')">
    <div class="container hero-content">
        <span class="hero-eyebrow"><x-icon name="sun" size="16" /> {{ setting('site_tagline') }}</span>
        <h1>{{ setting('hero_title', 'Jelajahi Pesona Nusantara') }}</h1>
        <p>{{ setting('hero_subtitle') }}</p>

        <form action="{{ route('packages.index') }}" method="GET" class="search-box">
            <label class="search-field">
                <x-icon name="search" size="18" />
                <input type="text" name="q" placeholder="Cari paket tour...">
            </label>
            <label class="search-field">
                <x-icon name="map-pin" size="18" />
                <select name="destination">
                    <option value="">Semua Destinasi</option>
                    @foreach ($allDestinations as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </label>
            <button class="btn btn-accent" type="submit">Cari Trip</button>
        </form>

        <div class="hero-stats">
            <div><strong data-count="25000">0</strong><span>Wisatawan Puas</span></div>
            <div><strong data-count="120">0</strong><span>Destinasi</span></div>
            <div><strong data-count="10">0</strong><span>Tahun Pengalaman</span></div>
        </div>
    </div>
</section>

{{-- DESTINASI POPULER --}}
<section class="section">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="eyebrow">Destinasi Populer</span>
                <h2>Ke Mana Liburan Anda Berikutnya?</h2>
            </div>
            <a href="{{ route('destinations.index') }}" class="link-arrow">Lihat semua <x-icon name="arrow-right" size="16" /></a>
        </div>
        <div class="destination-grid mosaic">
            @foreach ($destinations as $destination)
                @include('frontend.partials.destination-card')
            @endforeach
        </div>
    </div>
</section>

{{-- PAKET UNGGULAN --}}
<section class="section section-muted">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="eyebrow">Paket Unggulan</span>
                <h2>Paket Tour Pilihan Terbaik</h2>
            </div>
            <a href="{{ route('packages.index') }}" class="link-arrow">Semua paket <x-icon name="arrow-right" size="16" /></a>
        </div>
        <div class="card-grid">
            @foreach ($packages as $package)
                @include('frontend.partials.package-card')
            @endforeach
        </div>
    </div>
</section>

{{-- KENAPA KAMI --}}
<section class="section">
    <div class="container">
        <div class="section-head center reveal">
            <div>
                <span class="eyebrow">Kenapa Memilih Kami</span>
                <h2>Perjalanan Nyaman, Tanpa Khawatir</h2>
            </div>
        </div>
        <div class="feature-grid">
            @foreach ([
                ['wallet', 'Harga Transparan', 'Tanpa biaya tersembunyi. Semua tercantum jelas sejak awal.'],
                ['shield', 'Aman & Terpercaya', 'Berizin resmi dan didukung asuransi perjalanan.'],
                ['users', 'Pemandu Lokal', 'Guide berpengalaman yang mengenal setiap sudut destinasi.'],
                ['headset', 'Support 24/7', 'Tim kami siap membantu kapan pun selama perjalanan.'],
            ] as [$icon, $title, $text])
                <div class="feature reveal">
                    <span class="feature-icon"><x-icon :name="$icon" size="26" /></span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- TESTIMONI --}}
@if ($testimonials->isNotEmpty())
<section class="section section-dark">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="eyebrow">Testimoni</span>
                <h2>Cerita dari Para Traveler</h2>
            </div>
            <div class="slider-nav">
                <button class="slider-btn" data-slide="prev" aria-label="Sebelumnya"><x-icon name="chevron-left" /></button>
                <button class="slider-btn" data-slide="next" aria-label="Berikutnya"><x-icon name="chevron-right" /></button>
            </div>
        </div>
        <div class="slider" id="testimonialSlider">
            @foreach ($testimonials as $t)
                <figure class="testimonial">
                    <div class="stars">@for ($i = 0; $i < $t->rating; $i++)<x-icon name="star" size="16" />@endfor</div>
                    <blockquote>“{{ $t->message }}”</blockquote>
                    <figcaption>
                        <img src="{{ $t->photo_url }}" alt="{{ $t->name }}" loading="lazy">
                        <div><strong>{{ $t->name }}</strong><span>{{ $t->origin }}</span></div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- BLOG --}}
@if ($posts->isNotEmpty())
<section class="section">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <span class="eyebrow">Inspirasi Perjalanan</span>
                <h2>Artikel Terbaru</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="link-arrow">Baca blog <x-icon name="arrow-right" size="16" /></a>
        </div>
        <div class="card-grid">
            @foreach ($posts as $post)
                @include('frontend.blog.card')
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="section pt-0">
    <div class="container">
        <div class="cta reveal">
            <div>
                <h2>Punya Rencana Trip Sendiri?</h2>
                <p>Kami bisa buatkan paket private tour sesuai keinginan dan budget Anda.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-light">Konsultasi Gratis <x-icon name="arrow-right" size="16" /></a>
        </div>
    </div>
</section>
@endsection
