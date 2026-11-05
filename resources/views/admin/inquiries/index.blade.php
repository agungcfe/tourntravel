@extends('layouts.admin')

@section('title', 'Booking Masuk')

@section('content')
<div class="panel">
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <div class="search">
                <x-icon name="search" size="18" />
                <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari nama / email...">
            </div>
            <select class="input" name="status" onchange="this.form.submit()">
                <option value="">Semua status</option>
                @foreach (\App\Models\Inquiry::STATUSES as $key => $label)
                    <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Pengirim</th><th>Paket</th><th>Keberangkatan</th><th>Peserta</th><th>Masuk</th><th>Status</th><th class="right">Aksi</th></tr></thead>
            <tbody>
                @forelse ($inquiries as $inquiry)
                    <tr @class(['unread' => $inquiry->status === 'new'])>
                        <td><strong>{{ $inquiry->name }}</strong><br><small class="muted">{{ $inquiry->email }}</small></td>
                        <td>{{ $inquiry->package?->title ?? 'Pesan umum' }}</td>
                        <td>{{ $inquiry->travel_date?->translatedFormat('d M Y') ?? '-' }}</td>
                        <td>{{ $inquiry->participants ?? '-' }}</td>
                        <td>{{ $inquiry->created_at->diffForHumans() }}</td>
                        <td><span class="status s-{{ $inquiry->status }}">{{ $inquiry->status_label }}</span></td>
                        <td class="right actions">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="icon-btn" title="Detail"><x-icon name="eye" size="16" /></a>
                            @include('admin.partials.delete-button', ['action' => route('admin.inquiries.destroy', $inquiry), 'label' => 'booking ' . $inquiry->name])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty">Belum ada booking masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $inquiries->links() }}
</div>
@endsection
