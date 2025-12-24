<?php

namespace App\Models;

use App\Enums\CatRequestStatusEnum;
use App\Enums\CatRequestTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatRequest extends Model
{
    protected $fillable = [
        'user_id',
        'cat_id',
        'type',
        'status',
        'purpose',
        'manager_note',
        'amount',
        'is_paid',
    ];

    protected function casts(): array
    {
        return [
            'type' => CatRequestTypeEnum::class,
            'status' => CatRequestStatusEnum::class,
            'is_paid' => 'boolean',
            'amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cat(): BelongsTo
    {
        return $this->belongsTo(Cat::class);
    }
}
