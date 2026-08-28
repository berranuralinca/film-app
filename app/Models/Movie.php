<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'genre_id',
        'title',
        'description',
        'director',
        'release_year',
        'rating',
        'poster_image'];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
