<?php

namespace App\Filament\Resources\CatClasses\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CatClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(self::getComponents());
    }

    public static function getComponents(): array
    {
        return [
            TextInput::make('name')
                ->label('Название')
                ->maxLength(255)
                ->required(),

            Textarea::make('description')
                ->label('Описание')
                ->required()
                ->autosize()
                ->columnSpanFull(),
        ];
    }
}
