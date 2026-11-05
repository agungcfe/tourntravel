@extends('layouts.admin')

@section('title', $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
<form method="POST" enctype="multipart/form-data"
      action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
    @csrf
    @if ($testimonial->exists) @method('PUT') @endif

    <div class="form-layout">
        <div class="panel">
            <div class="grid-2">
                <label class="field"><span>Nama *</span><input class="input" name="name" value="{{ old('name', $testimonial->name) }}" required></label>
                <label class="field"><span>Asal Kota</span><input class="input" name="origin" value="{{ old('origin', $testimonial->origin) }}"></label>
            </div>
            <label class="field"><span>Pesan Testimoni *</span>
                <textarea class="input" name="message" rows="5" required>{{ old('message', $testimonial->message) }}</textarea>
            </label>
            <label class="field"><span>Rating *</span>
                <select class="input" name="rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>{{ str_repeat('★', $i) }} ({{ $i }})</option>
                    @endfor
                </select>
            </label>
        </div>
        <div class="panel">
            @include('admin.partials.image-input', ['name' => 'photo', 'current' => $testimonial->photo ? $testimonial->photo_url : null, 'label' => 'Foto'])
            @include('admin.partials.toggle', ['name' => 'is_active', 'checked' => old('is_active', $testimonial->is_active), 'label' => 'Tampilkan di website'])
            <div class="form-actions">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">Batal</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
