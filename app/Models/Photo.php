<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'advert_id'
    ];
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }
}
