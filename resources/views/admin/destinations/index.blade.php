@extends('layouts.admin')

@section('title', 'Destinasi')

@section('content')
<div class="panel">
    <div class="toolbar">
        <form method="GET" class="search">
            <x-icon name="search" size="18" />
            <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari destinasi atau provinsi...">
        </form>
        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary"><x-icon name="plus" size="16" /> Tambah Destinasi</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Destinasi</th><th>Provinsi</th><th>Paket</th><th>Status</th><th class="right">Aksi</th></tr></thead>
            <tbody>
                @forelse ($destinations as $destination)
                    <tr>
                        <td>
                            <div class="media">
                                <img src="{{ $destination->image_url }}" alt="">
                                <div><strong>{{ $destination->name }}</strong>@if ($destination->is_featured)<span class="tag">Unggulan</span>@endif</div>
                            </div>
                        </td>
                        <td>{{ $destination->province }}</td>
                        <td>{{ $destination->packages_count }}</td>
                        <td>@include('admin.partials.status', ['active' => $destination->is_active])</td>
                        <td class="right actions">
                            <a href="{{ route('destinations.show', $destination) }}" target="_blank" class="icon-btn" title="Lihat"><x-icon name="eye" size="16" /></a>
                            <a href="{{ route('admin.destinations.edit', $destination) }}" class="icon-btn" title="Edit"><x-icon name="edit" size="16" /></a>
                            @include('admin.partials.delete-button', ['action' => route('admin.destinations.destroy', $destination), 'label' => $destination->name])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Belum ada destinasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $destinations->links() }}
</div>
@endsection
