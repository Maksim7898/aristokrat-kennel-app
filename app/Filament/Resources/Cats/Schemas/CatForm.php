<?php

namespace App\Filament\Resources\Cats\Schemas;

use App\Enums\CatGenderEnum;
use App\Enums\CatStatusEnum;
use App\Filament\Resources\CatBreeds\Schemas\CatBreedForm;
use App\Filament\Resources\CatClasses\Schemas\CatClassForm;
use App\Models\Cat;
use App\Models\Post;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\TextSize;

class CatForm
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
                    ->hiddenOn('create'),

                TextEntry::make('views_count')
                    ->label('Просмотры')
                    ->helperText('общее количество просмотров')
                    ->state(fn (Cat $record) => views($record)->count())
                    ->fontFamily(FontFamily::Mono)
                    ->size(TextSize::Medium)
                    ->hiddenOn('create'),

                TextInput::make('name')
                    ->label('Кличка')
                    ->maxLength(255)
                    ->required(),

                TextInput::make('price')
                    ->label('Цена')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal')
                    ->prefix('₽'),

                Select::make('cat_breed_id')
                    ->label('Порода')
                    ->relationship('breed', 'name')
                    ->native(false)
                    ->searchable()
                    ->createOptionForm(CatBreedForm::getComponents())
                    ->createOptionModalHeading('Добавить новую породу')
                    ->required()
                    ->preload(),

                Select::make('cat_class_id')
                    ->label('Класс')
                    ->relationship('class', 'name')
                    ->native(false)
                    ->searchable()
                    ->createOptionForm(CatClassform::getComponents())
                    ->createOptionModalHeading('Добавить новый класс')
                    ->required()
                    ->preload(),

                Select::make('mother_id')
                    ->label('Мать')
                    ->relationship('mother', 'name')
                    ->native(false)
                    ->searchable()
                    ->preload(),

                Select::make('father_id')
                    ->label('Отец')
                    ->relationship('father', 'name')
                    ->native(false)
                    ->searchable()
                    ->preload(),

                DatePicker::make('date_of_birth')
                    ->label('Дата рождения')
                    ->required()
                    ->native(false)
                    ->displayFormat('d.m.Y')
                    ->maxDate(now())
                    ->placeholder('Выберите дату')
                    ->default(now()),

                Select::make('gender')
                    ->options(CatGenderEnum::class)
                    ->label('Пол')
                    ->native(false)
                    ->required(),

                Select::make('status')
                    ->options(CatStatusEnum::class)
                    ->label('Статус')
                    ->native(false)
                    ->required(),

                Textarea::make('character')
                    ->label('Описание характера')
                    ->required()
                    ->autosize(),

                Textarea::make('vaccination_info')
                    ->label('Информация о прививках')
                    ->required()
                    ->autosize(),
            ]);
    }
}
