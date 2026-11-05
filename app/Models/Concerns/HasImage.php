<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Mengubah nilai kolom gambar menjadi URL siap pakai.
 * Mendukung URL eksternal (http...) maupun file upload di storage/public.
 */
trait HasImage
{
    public function imageUrl(string $column = 'image', string $fallback = 'https://picsum.photos/seed/travel/1200/800'): string
    {
        $value = $this->{$column};

        if (empty($value)) {
            return $fallback;
        }

        return Str::startsWith($value, ['http://', 'https://']) ? $value : Storage::url($value);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->imageUrl();
    }
}
