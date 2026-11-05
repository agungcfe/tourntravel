@extends('layouts.admin')

@section('title', 'Paket Tour')

@section('content')
<div class="panel">
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <div class="search">
                <x-icon name="search" size="18" />
                <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari paket...">
            </div>
            <select class="input" name="destination" onchange="this.form.submit()">
                <option value="">Semua destinasi</option>
                @foreach ($destinations as $d)
                    <option value="{{ $d->id }}" @selected(request('destination') == $d->id)>{{ $d->name }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary"><x-icon name="plus" size="16" /> Tambah Paket</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Paket</th><th>Destinasi</th><th>Durasi</th><th>Harga</th><th>Status</th><th class="right">Aksi</th></tr></thead>
            <tbody>
                @forelse ($packages as $package)
                    <tr>
                        <td>
                            <div class="media">
                                <img src="{{ $package->image_url }}" alt="">
                                <div><strong>{{ $package->title }}</strong>@if ($package->is_featured)<span class="tag">Unggulan</span>@endif</div>
                            </div>
                        </td>
                        <td>{{ $package->destination->name }}</td>
                        <td>{{ $package->duration_label }}</td>
                        <td>
                            <strong>{{ rupiah($package->final_price) }}</strong>
                            @if ($package->discount_price)<br><del class="muted">{{ rupiah($package->price) }}</del>@endif
                        </td>
                        <td>@include('admin.partials.status', ['active' => $package->is_active])</td>
                        <td class="right actions">
                            <a href="{{ route('packages.show', $package) }}" target="_blank" class="icon-btn" title="Lihat"><x-icon name="eye" size="16" /></a>
                            <a href="{{ route('admin.packages.edit', $package) }}" class="icon-btn" title="Edit"><x-icon name="edit" size="16" /></a>
                            @include('admin.partials.delete-button', ['action' => route('admin.packages.destroy', $package), 'label' => $package->title])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">Belum ada paket tour.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $packages->links() }}
</div>
@endsection
