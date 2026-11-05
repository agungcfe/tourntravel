@extends('layouts.admin')

@section('title', $package->exists ? 'Edit Paket Tour' : 'Tambah Paket Tour')

@section('content')
<form method="POST" enctype="multipart/form-data"
      action="{{ $package->exists ? route('admin.packages.update', $package) : route('admin.packages.store') }}">
    @csrf
    @if ($package->exists) @method('PUT') @endif

    <div class="form-layout">
        <div class="stack">
            <div class="panel">
                <h3 class="panel-title">Informasi Paket</h3>
                <label class="field"><span>Judul Paket *</span>
                    <input class="input" name="title" value="{{ old('title', $package->title) }}" required>
                </label>
                <label class="field"><span>Destinasi *</span>
                    <select class="input" name="destination_id" required>
                        <option value="">-- Pilih destinasi --</option>
                        @foreach ($destinations as $d)
                            <option value="{{ $d->id }}" @selected(old('destination_id', $package->destination_id) == $d->id)>{{ $d->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="field"><span>Deskripsi Singkat</span>
                    <input class="input" name="short_description" value="{{ old('short_description', $package->short_description) }}" maxlength="255">
                </label>
                <label class="field"><span>Deskripsi Lengkap</span>
                    <textarea class="input" name="description" rows="5">{{ old('description', $package->description) }}</textarea>
                </label>
            </div>

            <div class="panel">
                <h3 class="panel-title">Detail Perjalanan</h3>
                <label class="field"><span>Itinerary <small>(satu hari per baris)</small></span>
                    <textarea class="input" name="itinerary" rows="5" placeholder="Hari 1: Penjemputan di bandara...">{{ old('itinerary', $package->itinerary) }}</textarea>
                </label>
                <div class="grid-2">
                    <label class="field"><span>Termasuk <small>(satu per baris)</small></span>
                        <textarea class="input" name="includes" rows="5">{{ old('includes', $package->includes) }}</textarea>
                    </label>
                    <label class="field"><span>Tidak Termasuk <small>(satu per baris)</small></span>
                        <textarea class="input" name="excludes" rows="5">{{ old('excludes', $package->excludes) }}</textarea>
                    </label>
                </div>
            </div>
        </div>

        <div class="stack">
            <div class="panel">
                <h3 class="panel-title">Harga & Durasi</h3>
                <label class="field"><span>Harga Normal (Rp) *</span>
                    <input class="input" type="number" name="price" value="{{ old('price', $package->price) }}" min="0" required>
                </label>
                <label class="field"><span>Harga Diskon (Rp)</span>
                    <input class="input" type="number" name="discount_price" value="{{ old('discount_price', $package->discount_price) }}" min="0">
                </label>
                <div class="grid-2">
                    <label class="field"><span>Hari *</span><input class="input" type="number" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" min="1" required></label>
                    <label class="field"><span>Malam *</span><input class="input" type="number" name="duration_nights" value="{{ old('duration_nights', $package->duration_nights) }}" min="0" required></label>
                </div>
                <div class="grid-2">
                    <label class="field"><span>Maks. Peserta *</span><input class="input" type="number" name="max_people" value="{{ old('max_people', $package->max_people) }}" min="1" required></label>
                    <label class="field"><span>Rating</span><input class="input" type="number" step="0.1" name="rating" value="{{ old('rating', $package->rating) }}" min="0" max="5"></label>
                </div>
            </div>

            <div class="panel">
                @include('admin.partials.image-input', ['name' => 'image', 'current' => $package->image ? $package->image_url : null])
                @include('admin.partials.toggle', ['name' => 'is_active', 'checked' => old('is_active', $package->is_active), 'label' => 'Tampilkan di website'])
                @include('admin.partials.toggle', ['name' => 'is_featured', 'checked' => old('is_featured', $package->is_featured), 'label' => 'Paket unggulan (beranda)'])
                <div class="form-actions">
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-light">Batal</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
