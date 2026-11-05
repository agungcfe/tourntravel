<?php

use App\Models\Setting;

if (! function_exists('rupiah')) {
    /** Format angka menjadi Rupiah, contoh: rupiah(1500000) => "Rp 1.500.000" */
    function rupiah(int|float|null $amount): string
    {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    }
}

if (! function_exists('setting')) {
    /** Ambil nilai pengaturan website, contoh: setting('site_name') */
    function setting(string $key, $default = null)
    {
        try {
            return Setting::get($key, $default);
        } catch (\Throwable) {
            return $default; // tabel belum dimigrasi
        }
    }
}

if (! function_exists('media_url')) {
    /** Ubah path upload / URL eksternal menjadi URL gambar siap pakai. */
    function media_url(?string $value, string $fallback = ''): string
    {
        if (empty($value)) {
            return $fallback;
        }

        return str_starts_with($value, 'http') ? $value : \Illuminate\Support\Facades\Storage::url($value);
    }
}
