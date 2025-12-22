<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CatStatusEnum: string implements HasLabel
{
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
