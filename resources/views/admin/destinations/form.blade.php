@extends('layouts.admin')

@section('title', $destination->exists ? 'Edit Destinasi' : 'Tambah Destinasi')

@section('content')
<form method="POST" enctype="multipart/form-data"
      action="{{ $destination->exists ? route('admin.destinations.update', $destination) : route('admin.destinations.store') }}">
    @csrf
    @if ($destination->exists) @method('PUT') @endif

    <div class="form-layout">
        <div class="panel">
            <label class="field"><span>Nama Destinasi *</span>
                <input class="input" name="name" value="{{ old('name', $destination->name) }}" required>
            </label>
            <label class="field"><span>Provinsi *</span>
                <input class="input" name="province" value="{{ old('province', $destination->province) }}" required>
            </label>
            <label class="field"><span>Deskripsi Singkat</span>
                <input class="input" name="short_description" value="{{ old('short_description', $destination->short_description) }}" maxlength="255">
            </label>
            <label class="field"><span>Deskripsi Lengkap</span>
                <textarea class="input" name="description" rows="8">{{ old('description', $destination->description) }}</textarea>
            </label>
        </div>

        <div class="panel">
            @include('admin.partials.image-input', ['name' => 'image', 'current' => $destination->image ? $destination->image_url : null])
            @include('admin.partials.toggle', ['name' => 'is_active', 'checked' => old('is_active', $destination->is_active), 'label' => 'Tampilkan di website'])
            @include('admin.partials.toggle', ['name' => 'is_featured', 'checked' => old('is_featured', $destination->is_featured), 'label' => 'Destinasi unggulan (beranda)'])
            <div class="form-actions">
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-light">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
