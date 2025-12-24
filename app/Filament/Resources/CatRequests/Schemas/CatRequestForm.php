<?php

namespace App\Filament\Resources\CatRequests\Schemas;

use App\Enums\CatGenderEnum;
use App\Enums\CatRequestStatusEnum;
use App\Enums\CatRequestTypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CatRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Пользователь')
                    ->relationship('user', 'full_name')
                    ->searchable(['full_name', 'email'])
                    ->native(false)
                    ->required()
                    ->preload(),

                Select::make('cat_id')
                    ->label('Кот')
                    ->relationship('cat', 'name')
                    ->native(false)
                    ->searchable()
                    ->required()
                    ->preload(),

                Select::make('type')
                    ->options(CatRequestTypeEnum::class)
                    ->label('Тип заявки')
                    ->native(false)
                    ->required(),

                Select::make('status')
                    ->options(CatRequestStatusEnum::class)
                    ->label('Статус заявки')
                    ->native(false)
                    ->required(),

                TextInput::make('amount')
                    ->label('Сумма')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal')
                    ->prefix('₽'),

                Toggle::make('is_paid')
                    ->label('Оплачено')
                    ->required()
                    ->inline(false)
                    ->default(false),

                Textarea::make('purpose')
                    ->label('Цель приобретения')
                    ->autosize(),

                Textarea::make('manager_note')
                    ->label('Заметки менеджера (видны только в админ панели)')
                    ->autosize(),
            ]);
    }
}
