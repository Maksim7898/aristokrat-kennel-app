<?php

namespace App\Enums;

use App\Traits\Enums\HasValues;
use Filament\Support\Contracts\HasLabel;

enum CatRequestTypeEnum: string implements HasLabel
{
    use HasValues;

    case RESERVATION = 'reservation';
    case PURCHASE = 'purchase';

    public function getLabel(): string
    {
        return match ($this) {
            self::RESERVATION => 'Бронирование',
            self::PURCHASE => 'Покупка',
        };
    }
}
