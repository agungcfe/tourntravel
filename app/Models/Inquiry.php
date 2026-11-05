<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    public const STATUSES = [
        'new' => 'Baru',
        'contacted' => 'Dihubungi',
        'confirmed' => 'Terkonfirmasi',
        'cancelled' => 'Dibatalkan',
    ];

    protected $fillable = ['package_id', 'name', 'email', 'phone', 'travel_date', 'participants', 'message', 'status'];

    protected $casts = [
        'travel_date' => 'date',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
