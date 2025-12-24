<?php

namespace App\Enums;

use App\Traits\Enums\HasValues;
use Filament\Support\Contracts\HasLabel;

enum CatRequestStatusEnum: string implements HasLabel
{
    use HasValues;

    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case READY = 'ready';
    case CANCELED = 'canceled';
    case CANCELED_BY_USER = 'canceled_by_user';

    public function getLabel(): string
    {
        return match ($this) {
            self::NEW => 'Новая',
            self::IN_PROGRESS => 'В работе',
            self::READY => 'Готова',
            self::CANCELED => 'Отменена',
            self::CANCELED_BY_USER => 'Отменена пользователем',
        };
    }
}
