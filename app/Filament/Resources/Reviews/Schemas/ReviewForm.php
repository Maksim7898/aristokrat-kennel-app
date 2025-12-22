<?php

namespace App\Filament\Resources\Reviews\Schemas;

use App\Enums\ReviewStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\TextSize;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug')
                    ->label('ЧПУ')
                    ->helperText('генерируется всегда автоматически используя краткий заголовок')
                    ->copyable()
                    ->fontFamily(FontFamily::Mono)
                    ->size(TextSize::Medium)
                    ->columnSpanFull()
                    ->hiddenOn('create'),

                Select::make('user_id')
                    ->label('Пользователь')
                    ->relationship('user', 'full_name')
                    ->native(false)
                    ->searchable(['full_name', 'email'])
                    ->required()
                    ->preload(),

                Select::make('cat_id')
                    ->label('Кот')
                    ->relationship('cat', 'name')
                    ->native(false)
                    ->searchable()
                    ->required()
                    ->preload(),

                Select::make('status')
                    ->options(ReviewStatusEnum::class)
                    ->label('Статус')
                    ->native(false)
                    ->required(),

                Select::make('rating')
                    ->label('Рейтинг (звезды)')
                    ->options([
                        5 => '⭐⭐⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        3 => '⭐⭐⭐',
                        2 => '⭐⭐',
                        1 => '⭐',
                    ])
                    ->required()
                    ->native(false)
                    ->default(5),

                Textarea::make('comment')
                    ->label('Комментарий пользователя')
                    ->required()
                    ->autosize()
                    ->columnSpanFull(),
            ]);
    }
}
