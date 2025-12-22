<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRoleEnum: string implements HasLabel
{
    case ADMIN = 'admin';
    case SALES_MANAGER = 'sales_manager';
    case EDITOR = 'editor';
    case USER = 'user';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Админ',
            self::SALES_MANAGER => 'Менеджер продаж',
            self::EDITOR => 'Редактор',
            self::USER => 'Пользователь',
        };
    }
}
