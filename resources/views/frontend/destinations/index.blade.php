@extends('layouts.frontend')

@section('title', 'Destinasi Wisata')

@section('content')
@include('frontend.partials.page-header', [
    'title' => 'Destinasi Wisata',
    'subtitle' => 'Dari Sabang sampai Merauke — temukan destinasi impian Anda.',
    'image' => 'https://picsum.photos/seed/destinasi-header/1920/600',
])

<section class="section">
    <div class="container">
        <div class="destination-grid">
            @forelse ($destinations as $destination)
                @include('frontend.partials.destination-card')
            @empty
                <p class="empty">Belum ada destinasi.</p>
            @endforelse
        </div>
        {{ $destinations->links() }}
    </div>
</section>
@endsection
