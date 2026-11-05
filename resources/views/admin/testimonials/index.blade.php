@extends('layouts.admin')

@section('title', 'Testimoni')

@section('content')
<div class="panel">
    <div class="toolbar">
        <p class="muted">Testimoni aktif tampil di halaman beranda.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><x-icon name="plus" size="16" /> Tambah Testimoni</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Pelanggan</th><th>Pesan</th><th>Rating</th><th>Status</th><th class="right">Aksi</th></tr></thead>
            <tbody>
                @forelse ($testimonials as $t)
                    <tr>
                        <td><div class="media"><img class="round" src="{{ $t->photo_url }}" alt=""><div><strong>{{ $t->name }}</strong><br><small class="muted">{{ $t->origin }}</small></div></div></td>
                        <td class="truncate">{{ $t->message }}</td>
                        <td class="stars">{{ str_repeat('★', $t->rating) }}</td>
                        <td>@include('admin.partials.status', ['active' => $t->is_active])</td>
                        <td class="right actions">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="icon-btn" title="Edit"><x-icon name="edit" size="16" /></a>
                            @include('admin.partials.delete-button', ['action' => route('admin.testimonials.destroy', $t), 'label' => $t->name])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Belum ada testimoni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $testimonials->links() }}
</div>
@endsection
