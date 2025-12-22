<?php

namespace App\Filament\Resources\Reviews\Tables;

use App\Enums\ReviewStatusEnum;
use App\Models\Review;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('user.full_name')
                    ->label('Пользователь')
                    ->searchable(['full_name', 'email'])
                    ->sortable()
                    ->description(fn (Review $record): string => $record->user->email)
                    ->toggleable(),

                TextColumn::make('cat.name')
                    ->label('Кот')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Review $record): string => $record->cat->gender->getLabel())
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('rating')
                    ->label('Рейтинг')
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
                SelectFilter::make('status')
                    ->label('Статус')
                    ->native(false)
                    ->options(ReviewStatusEnum::class),

                SelectFilter::make('user_id')
                    ->label('Пользователь')
                    ->relationship('user', 'full_name')
                    ->searchable(['full_name', 'email'])
                    ->native(false)
                    ->preload(),

                SelectFilter::make('cat_id')
                    ->label('Кот')
                    ->relationship('cat', 'name')
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
