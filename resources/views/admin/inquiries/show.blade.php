@extends('layouts.admin')

@section('title', 'Detail Booking')

@section('content')
<div class="form-layout">
    <div class="panel">
        <div class="panel-head">
            <h3>{{ $inquiry->name }}</h3>
            <span class="status s-{{ $inquiry->status }}">{{ $inquiry->status_label }}</span>
        </div>
        <dl class="detail-list">
            <dt>Email</dt><dd><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></dd>
            <dt>Telepon / WA</dt><dd>{{ $inquiry->phone ?? '-' }}</dd>
            <dt>Paket</dt><dd>{{ $inquiry->package?->title ?? 'Pesan umum (halaman kontak)' }}</dd>
            <dt>Tanggal Berangkat</dt><dd>{{ $inquiry->travel_date?->translatedFormat('d F Y') ?? '-' }}</dd>
            <dt>Jumlah Peserta</dt><dd>{{ $inquiry->participants ?? '-' }}</dd>
            @if ($inquiry->package && $inquiry->participants)
                <dt>Estimasi Total</dt><dd><strong>{{ rupiah($inquiry->package->final_price * $inquiry->participants) }}</strong></dd>
            @endif
            <dt>Dikirim</dt><dd>{{ $inquiry->created_at->translatedFormat('d F Y, H:i') }} WIB</dd>
            <dt>Pesan</dt><dd>{!! nl2br(e($inquiry->message ?? '-')) !!}</dd>
        </dl>
    </div>

    <div class="panel">
        <h3 class="panel-title">Tindak Lanjut</h3>
        <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}">
            @csrf @method('PUT')
            <label class="field"><span>Ubah Status</span>
                <select class="input" name="status">
                    @foreach (\App\Models\Inquiry::STATUSES as $key => $label)
                        <option value="{{ $key }}" @selected($inquiry->status === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            <button class="btn btn-primary btn-block">Simpan Status</button>
        </form>
        @if ($inquiry->phone)
            <a class="btn btn-whatsapp btn-block" target="_blank" rel="noopener"
               href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $inquiry->phone)) }}?text={{ urlencode('Halo ' . $inquiry->name . ', terima kasih telah menghubungi ' . setting('site_name') . '.') }}">
                <x-icon name="whatsapp" size="18" /> Balas via WhatsApp
            </a>
        @endif
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-light btn-block">Kembali</a>
    </div>
</div>
@endsection
