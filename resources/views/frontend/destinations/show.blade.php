@extends('layouts.frontend')

@section('title', 'Wisata ' . $destination->name)
@section('meta_description', (string) $destination->short_description)

@section('content')
@include('frontend.partials.page-header', [
    'title' => $destination->name,
    'subtitle' => $destination->province,
    'image' => $destination->image_url,
])

<section class="section">
    <div class="container">
        <div class="intro reveal">
            <h2>Tentang {{ $destination->name }}</h2>
            <p>{!! nl2br(e($destination->description)) !!}</p>
        </div>

        <div class="section-head reveal">
            <div>
                <span class="eyebrow">{{ $packages->count() }} Paket Tersedia</span>
                <h2>Paket Tour ke {{ $destination->name }}</h2>
            </div>
        </div>

        <div class="card-grid">
            @forelse ($packages as $package)
                @include('frontend.partials.package-card')
            @empty
                <p class="empty">Belum ada paket untuk destinasi ini. <a href="{{ route('contact') }}">Request private trip</a>.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
