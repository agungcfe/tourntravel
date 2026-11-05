<?php

namespace App\Models;

use App\Models\Concerns\HasImage;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory, HasImage, HasSlug;

    protected string $slugSource = 'title';

    protected $fillable = [
        'destination_id', 'title', 'slug', 'duration_days', 'duration_nights', 'price', 'discount_price',
        'max_people', 'short_description', 'description', 'itinerary', 'includes', 'excludes',
        'image', 'rating', 'is_featured', 'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'discount_price' => 'integer',
        'rating' => 'float',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /** Harga yang dibayar pelanggan (pakai harga diskon bila ada). */
    public function getFinalPriceAttribute(): int
    {
        return $this->discount_price ?: $this->price;
    }

    public function getDurationLabelAttribute(): string
    {
        return $this->duration_nights > 0
            ? "{$this->duration_days} Hari {$this->duration_nights} Malam"
            : "{$this->duration_days} Hari";
    }

    /** Ubah teks multi-baris (itinerary, includes, excludes) menjadi array. */
    public function lines(string $column): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $this->{$column}))));
    }
}
