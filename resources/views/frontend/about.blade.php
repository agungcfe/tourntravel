@extends('layouts.frontend')

@section('title', 'Tentang Kami')

@section('content')
@include('frontend.partials.page-header', [
    'title' => 'Tentang Kami',
    'subtitle' => (string) setting('site_tagline'),
    'image' => 'https://picsum.photos/seed/about-header/1920/600',
])

<section class="section">
    <div class="container about-grid">
        <div class="reveal">
            <span class="eyebrow">Siapa Kami</span>
            <h2>Partner Perjalanan Anda Menjelajahi Indonesia</h2>
            <div class="prose">{!! nl2br(e(setting('about_text'))) !!}</div>
            <a href="{{ route('packages.index') }}" class="btn btn-primary">Lihat Paket Tour</a>
        </div>
        <div class="about-images reveal">
            <img src="https://picsum.photos/seed/about1/600/800" alt="Tim kami" loading="lazy">
            <img src="https://picsum.photos/seed/about2/600/800" alt="Perjalanan" loading="lazy">
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <div class="feature-grid">
            @foreach ([['25.000+', 'Wisatawan Puas'], ['120+', 'Destinasi'], ['50+', 'Pemandu Lokal'], ['4.9/5', 'Rating Pelanggan']] as [$num, $label])
                <div class="feature stat reveal"><strong>{{ $num }}</strong><p>{{ $label }}</p></div>
            @endforeach
        </div>
    </div>
</section>
@endsection
