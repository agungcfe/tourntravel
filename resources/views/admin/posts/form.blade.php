@extends('layouts.admin')

@section('title', $post->exists ? 'Edit Artikel' : 'Tulis Artikel')

@section('content')
<form method="POST" enctype="multipart/form-data"
      action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}">
    @csrf
    @if ($post->exists) @method('PUT') @endif

    <div class="form-layout">
        <div class="panel">
            <label class="field"><span>Judul Artikel *</span>
                <input class="input input-lg" name="title" value="{{ old('title', $post->title) }}" required>
            </label>
            <label class="field"><span>Ringkasan</span>
                <textarea class="input" name="excerpt" rows="2" maxlength="300">{{ old('excerpt', $post->excerpt) }}</textarea>
            </label>
            <div class="field">
                <span>Isi Artikel * <small>(mendukung HTML)</small></span>
                <div class="editor-toolbar" data-editor-for="body">
                    <button type="button" data-wrap="<strong>|</strong>"><b>B</b></button>
                    <button type="button" data-wrap="<em>|</em>"><i>I</i></button>
                    <button type="button" data-wrap="<h2>|</h2>">H2</button>
                    <button type="button" data-wrap="<h3>|</h3>">H3</button>
                    <button type="button" data-wrap="<p>|</p>">P</button>
                    <button type="button" data-wrap="<ul>\n  <li>|</li>\n</ul>">• List</button>
                    <button type="button" data-wrap='<a href="https://">|</a>'>Link</button>
                </div>
                <textarea class="input mono" id="body" name="body" rows="16" required>{{ old('body', $post->body) }}</textarea>
            </div>
        </div>

        <div class="panel">
            <label class="field"><span>Status *</span>
                <select class="input" name="status">
                    <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $post->status) === 'published')>Terbit</option>
                </select>
            </label>
            <label class="field"><span>Tanggal Terbit <small>(kosongkan = sekarang)</small></span>
                <input class="input" type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
            </label>
            <label class="field"><span>Kategori</span>
                <select class="input" name="category_id">
                    <option value="">-- Tanpa kategori --</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" @selected(old('category_id', $post->category_id) == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </label>
            @include('admin.partials.image-input', ['name' => 'image', 'current' => $post->image ? $post->image_url : null, 'label' => 'Gambar Utama'])
            <div class="form-actions">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-light">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
