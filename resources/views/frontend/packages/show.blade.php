@extends('layouts.frontend')

@section('title', $package->title)
@section('meta_description', (string) $package->short_description)

@section('content')
@include('frontend.partials.page-header', ['title' => $package->title, 'subtitle' => $package->destination->name . ', ' . $package->destination->province, 'image' => $package->image_url])

<section class="section">
    <div class="container layout-sidebar">
        <div class="package-detail">
            <img class="article-cover reveal" src="{{ $package->image_url }}" alt="{{ $package->title }}">

            <div class="quick-info reveal">
                <div><x-icon name="clock" /><span>Durasi</span><strong>{{ $package->duration_label }}</strong></div>
                <div><x-icon name="users" /><span>Maks. Peserta</span><strong>{{ $package->max_people }} orang</strong></div>
                <div><x-icon name="map-pin" /><span>Lokasi</span><strong>{{ $package->destination->name }}</strong></div>
                <div><x-icon name="star" /><span>Rating</span><strong>{{ number_format($package->rating, 1) }} / 5</strong></div>
            </div>

            <div class="tabs reveal" data-tabs>
                <div class="tab-list" role="tablist">
                    <button class="tab active" data-tab="overview">Deskripsi</button>
                    <button class="tab" data-tab="itinerary">Itinerary</button>
                    <button class="tab" data-tab="include">Termasuk</button>
                </div>

                <div class="tab-panel active" id="overview">
                    <p>{!! nl2br(e($package->description)) !!}</p>
                </div>

                <div class="tab-panel" id="itinerary">
                    <ol class="timeline">
                        @foreach ($package->lines('itinerary') as $day)
                            <li>{{ $day }}</li>
                        @endforeach
                    </ol>
                </div>

                <div class="tab-panel" id="include">
                    <div class="include-grid">
                        <div>
                            <h4>Sudah Termasuk</h4>
                            <ul class="check-list">
                                @foreach ($package->lines('includes') as $item)<li><x-icon name="check" size="16" /> {{ $item }}</li>@endforeach
                            </ul>
                        </div>
                        <div>
                            <h4>Tidak Termasuk</h4>
                            <ul class="check-list excluded">
                                @foreach ($package->lines('excludes') as $item)<li><x-icon name="minus" size="16" /> {{ $item }}</li>@endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside class="sidebar">
            <div class="sidebar-box booking-box" id="booking">
                <div class="price price-lg">
                    <small>Harga per orang</small>
                    @if ($package->discount_price)<del>{{ rupiah($package->price) }}</del>@endif
                    <strong>{{ rupiah($package->final_price) }}</strong>
                </div>

                @include('frontend.partials.alert')

                <form action="{{ route('inquiries.store') }}" method="POST" class="form">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input class="input" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
                    <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    <input class="input" name="phone" value="{{ old('phone') }}" placeholder="No. WhatsApp">
                    <div class="form-row">
                        <input class="input" type="date" name="travel_date" value="{{ old('travel_date') }}" min="{{ date('Y-m-d') }}" aria-label="Tanggal berangkat">
                        <input class="input" type="number" name="participants" value="{{ old('participants', 2) }}" min="1" max="{{ $package->max_people }}" aria-label="Jumlah peserta">
                    </div>
                    <textarea class="input" name="message" rows="3" placeholder="Catatan (opsional)">{{ old('message') }}</textarea>
                    <button class="btn btn-primary btn-block">Booking Sekarang</button>
                </form>
                @if (setting('contact_whatsapp'))
                    <a class="btn btn-outline btn-block" target="_blank" rel="noopener"
                       href="https://wa.me/{{ setting('contact_whatsapp') }}?text={{ urlencode('Halo, saya tertarik dengan paket ' . $package->title) }}">
                        <x-icon name="whatsapp" size="18" /> Tanya via WhatsApp
                    </a>
                @endif
            </div>
        </aside>
    </div>

    @if ($related->isNotEmpty())
        <div class="container">
            <div class="section-head reveal"><div><span class="eyebrow">Paket Lainnya</span><h2>Mungkin Anda Juga Suka</h2></div></div>
            <div class="card-grid">
                @foreach ($related as $package)
                    @include('frontend.partials.package-card')
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
