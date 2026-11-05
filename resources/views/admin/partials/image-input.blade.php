{{-- Input upload gambar dengan preview. Parameter: $name, $current (url|null), $label --}}
<div class="field">
    <span>{{ $label ?? 'Gambar' }}</span>
    <label class="image-input">
        <img src="{{ $current ?? '' }}" alt="" data-preview @class(['hidden' => empty($current)])>
        <span @class(['image-placeholder', 'hidden' => ! empty($current)])>
            <x-icon name="image" size="28" />
            <small>Klik untuk upload (JPG/PNG, maks 2MB)</small>
        </span>
        <input type="file" name="{{ $name }}" accept="image/*" data-image-input>
    </label>
</div>
