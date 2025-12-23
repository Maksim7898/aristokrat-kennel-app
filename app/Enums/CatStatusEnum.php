<?php

namespace App\Enums;

use App\Traits\Enums\HasValues;
use Filament\Support\Contracts\HasLabel;

enum CatStatusEnum: string implements HasLabel
{
    use HasValues;

    case FOR_SALE = 'for_sale';
    case SOLD = 'sold';

    public function getLabel(): string
    {
        return match ($this) {
            self::FOR_SALE => 'В продаже',
            self::SOLD => 'Продано',
        };
    }
}
