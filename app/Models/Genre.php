<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Genre extends Model
{
    protected $fillable = ["name","slug"];
    //1 tür çok sayıda film 
    public function movies(): HasMany{
        return $this->hasMany(Genre::class);
    }
}
