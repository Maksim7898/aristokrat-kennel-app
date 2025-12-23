<?php

namespace App\Filament\Resources\Cats\Tables;

use App\Enums\CatGenderEnum;
use App\Enums\CatStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('slug')
                    ->label('ЧПУ')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Кличка')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('gender')
                    ->label('Пол')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('breed.name')
                    ->label('Порода')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('class.name')
                    ->label('Порода')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('mother.name')
                    ->label('Кличка матери')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('father.name')
                    ->label('Кличка отца')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('views_count')
                    ->label('Просмотры')
                    ->counts('views')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Дата изменения')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->deferFilters(false)
            ->filters([
                SelectFilter::make('gender')
                    ->label('Пол')
                    ->native(false)
                    ->options(CatGenderEnum::class),

                SelectFilter::make('status')
                    ->label('Статус')
                    ->native(false)
                    ->options(CatStatusEnum::class),

                SelectFilter::make('cat_breed_id')
                    ->label('Порода')
                    ->relationship('breed', 'name')
                    ->searchable()
                    ->native(false)
                    ->preload(),

                SelectFilter::make('cat_class_id')
                    ->label('Класс')
                    ->relationship('class', 'name')
                    ->searchable()
                    ->native(false)
                    ->preload(),

                SelectFilter::make('mother_id')
                    ->label('Мать')
                    ->relationship('mother', 'name')
                    ->searchable()
                    ->native(false)
                    ->preload(),

                SelectFilter::make('father_id')
                    ->label('Отец')
                    ->relationship('father', 'name')
                    ->searchable()
                    ->native(false)
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
