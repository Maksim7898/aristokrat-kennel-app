<?php

namespace App\Enums;

use App\Traits\Enums\HasValues;
use Filament\Support\Contracts\HasLabel;

enum CatGenderEnum: string implements HasLabel
{
    use HasValues;

    case MALE = 'male';
    case FEMALE = 'female';

    public function getLabel(): string
    {
        return match ($this) {
            self::MALE => 'Мужской',
            self::FEMALE => 'Женский',
        };
    }
}
