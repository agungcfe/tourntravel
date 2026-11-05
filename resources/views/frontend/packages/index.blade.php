@extends('layouts.frontend')

@section('title', 'Paket Tour')

@section('content')
@include('frontend.partials.page-header', [
    'title' => 'Paket Tour',
    'subtitle' => 'Pilih paket perjalanan terbaik sesuai gaya liburan Anda.',
    'image' => 'https://picsum.photos/seed/paket-header/1920/600',
])

<section class="section">
    <div class="container">
        <form method="GET" class="filter-bar reveal">
            <label class="search-field">
                <x-icon name="search" size="18" />
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari paket...">
            </label>
            <label class="search-field">
                <x-icon name="map-pin" size="18" />
                <select name="destination">
                    <option value="">Semua Destinasi</option>
                    @foreach ($destinations as $d)
                        <option value="{{ $d->id }}" @selected(request('destination') == $d->id)>{{ $d->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="search-field">
                <select name="sort">
                    <option value="">Terbaru</option>
                    <option value="price_asc" @selected(request('sort') === 'price_asc')>Harga Terendah</option>
                    <option value="price_desc" @selected(request('sort') === 'price_desc')>Harga Tertinggi</option>
                </select>
            </label>
            <button class="btn btn-primary">Filter</button>
        </form>

        <p class="result-count">Menampilkan {{ $packages->total() }} paket</p>

        <div class="card-grid">
            @forelse ($packages as $package)
                @include('frontend.partials.package-card')
            @empty
                <p class="empty">Paket tidak ditemukan. Coba kata kunci lain.</p>
            @endforelse
        </div>

        {{ $packages->links() }}
    </div>
</section>
@endsection
