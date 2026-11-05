<?php

namespace App\Models;

use App\Models\Concerns\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasImage;

    protected $fillable = ['name', 'origin', 'message', 'rating', 'photo', 'is_active'];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->imageUrl('photo', 'https://ui-avatars.com/api/?background=0f766e&color=fff&name=' . urlencode($this->name));
    }
}
