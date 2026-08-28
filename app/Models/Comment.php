<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'movie_id',
        'author_name',
        'content',
        'rating'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
