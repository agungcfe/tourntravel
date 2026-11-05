@extends('layouts.frontend')

@section('title', 'Hubungi Kami')

@section('content')
@include('frontend.partials.page-header', [
    'title' => 'Hubungi Kami',
    'subtitle' => 'Ceritakan rencana perjalanan Anda, kami bantu wujudkan.',
    'image' => 'https://picsum.photos/seed/kontak-header/1920/600',
])

<section class="section">
    <div class="container contact-grid">
        <div class="contact-info reveal">
            <h2>Mari Ngobrol!</h2>
            <p>Tim travel consultant kami siap membantu Senin–Sabtu, 08.00–20.00 WIB.</p>
            <ul>
                <li><span class="feature-icon"><x-icon name="map-pin" /></span><div><strong>Alamat</strong><p>{{ setting('contact_address') }}</p></div></li>
                <li><span class="feature-icon"><x-icon name="phone" /></span><div><strong>Telepon</strong><p>{{ setting('contact_phone') }}</p></div></li>
                <li><span class="feature-icon"><x-icon name="mail" /></span><div><strong>Email</strong><p>{{ setting('contact_email') }}</p></div></li>
            </ul>
        </div>

        <div class="sidebar-box reveal">
            <h3>Kirim Pesan</h3>
            @include('frontend.partials.alert')
            <form action="{{ route('inquiries.store') }}" method="POST" class="form">
                @csrf
                <div class="form-row">
                    <input class="input" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
                    <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                </div>
                <div class="form-row">
                    <input class="input" name="phone" value="{{ old('phone') }}" placeholder="No. WhatsApp">
                    <input class="input" type="date" name="travel_date" value="{{ old('travel_date') }}" min="{{ date('Y-m-d') }}" aria-label="Rencana tanggal berangkat">
                </div>
                <textarea class="input" name="message" rows="5" placeholder="Ceritakan rencana perjalanan Anda..." required>{{ old('message') }}</textarea>
                <button class="btn btn-primary">Kirim Pesan <x-icon name="arrow-right" size="16" /></button>
            </form>
        </div>
    </div>
</section>
@endsection
