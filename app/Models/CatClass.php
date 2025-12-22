<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatClass extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function cats(): HasMany
    {
        return $this->hasMany(Cat::class);
    }
}
