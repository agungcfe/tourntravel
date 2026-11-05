@extends('layouts.admin')

@section('title', 'Artikel Blog')

@section('content')
<div class="panel">
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <div class="search">
                <x-icon name="search" size="18" />
                <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari judul artikel...">
            </div>
            <select class="input" name="status" onchange="this.form.submit()">
                <option value="">Semua status</option>
                <option value="published" @selected(request('status') === 'published')>Terbit</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
            </select>
        </form>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary"><x-icon name="plus" size="16" /> Tulis Artikel</a>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead><tr><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Tanggal</th><th>Status</th><th class="right">Aksi</th></tr></thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td><div class="media"><img src="{{ $post->image_url }}" alt=""><strong>{{ $post->title }}</strong></div></td>
                        <td>{{ $post->category?->name ?? '-' }}</td>
                        <td>{{ $post->author?->name ?? '-' }}</td>
                        <td>{{ $post->published_at?->translatedFormat('d M Y') ?? '-' }}</td>
                        <td>@include('admin.partials.status', ['active' => $post->status === 'published', 'on' => 'Terbit', 'off' => 'Draft'])</td>
                        <td class="right actions">
                            @if ($post->status === 'published')
                                <a href="{{ route('blog.show', $post) }}" target="_blank" class="icon-btn" title="Lihat"><x-icon name="eye" size="16" /></a>
                            @endif
                            <a href="{{ route('admin.posts.edit', $post) }}" class="icon-btn" title="Edit"><x-icon name="edit" size="16" /></a>
                            @include('admin.partials.delete-button', ['action' => route('admin.posts.destroy', $post), 'label' => $post->title])
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">Belum ada artikel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $posts->links() }}
</div>
@endsection
