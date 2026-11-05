<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * Membuat slug otomatis dari kolom judul/nama saat data disimpan.
 * Model cukup mengisi properti $slugSource (default: 'name').
 */
trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            $source = $model->slugSource ?? 'name';

            if (empty($model->slug) || $model->isDirty($source)) {
                $model->slug = static::uniqueSlug(Str::slug($model->{$source}), $model->id);
            }
        });
    }

    protected static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base ?: Str::random(8);
        $i = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
