@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="welcome">
    <div>
        <h2>Halo, {{ auth()->user()->name }}! 👋</h2>
        <p>Berikut ringkasan aktivitas website hari ini, {{ now()->translatedFormat('l, d F Y') }}.</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-light"><x-icon name="plus" size="16" /> Paket Baru</a>
</div>

<div class="stats">
    @foreach ([
        ['inbox', 'Booking Baru', $stats['inquiries_new'], 'admin.inquiries.index', 'orange'],
        ['map-pin', 'Destinasi', $stats['destinations'], 'admin.destinations.index', 'teal'],
        ['package', 'Paket Tour', $stats['packages'], 'admin.packages.index', 'blue'],
        ['file-text', 'Artikel', $stats['posts'], 'admin.posts.index', 'purple'],
    ] as [$icon, $label, $value, $route, $color])
        <a href="{{ route($route) }}" class="stat-card">
            <span class="stat-icon {{ $color }}"><x-icon :name="$icon" /></span>
            <div><small>{{ $label }}</small><strong>{{ $value }}</strong></div>
        </a>
    @endforeach
</div>

<div class="grid-2">
    <div class="panel">
        <div class="panel-head"><h3>Booking 6 Bulan Terakhir</h3></div>
        @php $max = max(1, $chart->max('total')); @endphp
        <div class="bar-chart">
            @foreach ($chart as $bar)
                <div class="bar-col">
                    <span class="bar-value">{{ $bar['total'] }}</span>
                    <div class="bar" style="--h: {{ ($bar['total'] / $max) * 100 }}%"></div>
                    <small>{{ $bar['label'] }}</small>
                </div>
            @endforeach
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <h3>Artikel Terbaru</h3>
            <a href="{{ route('admin.posts.index') }}">Lihat semua</a>
        </div>
        <ul class="list">
            @forelse ($latestPosts as $post)
                <li>
                    <a href="{{ route('admin.posts.edit', $post) }}">{{ $post->title }}</a>
                    @include('admin.partials.status', ['active' => $post->status === 'published', 'on' => 'Terbit', 'off' => 'Draft'])
                </li>
            @empty
                <li class="muted">Belum ada artikel.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <h3>Booking Terbaru</h3>
        <a href="{{ route('admin.inquiries.index') }}">Lihat semua</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Nama</th><th>Paket</th><th>Tanggal</th><th>Status</th></tr></thead>
            <tbody>
                @forelse ($latestInquiries as $inquiry)
                    <tr>
                        <td><a href="{{ route('admin.inquiries.show', $inquiry) }}"><strong>{{ $inquiry->name }}</strong></a><br><small class="muted">{{ $inquiry->email }}</small></td>
                        <td>{{ $inquiry->package?->title ?? 'Pesan umum' }}</td>
                        <td>{{ $inquiry->created_at->translatedFormat('d M Y') }}</td>
                        <td><span class="status s-{{ $inquiry->status }}">{{ $inquiry->status_label }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">Belum ada booking masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
