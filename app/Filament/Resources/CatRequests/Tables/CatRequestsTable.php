<?php

namespace App\Filament\Resources\CatRequests\Tables;

use App\Enums\CatRequestStatusEnum;
use App\Enums\CatRequestTypeEnum;
use App\Models\CatRequest;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CatRequestsTable
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
                    ->description(fn (CatRequest $record): string => $record->user->email)
                    ->toggleable(),

                TextColumn::make('cat.name')
                    ->label('Кот')
                    ->searchable()
                    ->sortable()
                    ->description(fn (CatRequest $record): string => $record->cat->gender->getLabel())
                    ->toggleable(),

                TextColumn::make('type')
                    ->label('Тип заявки')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Статус')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('amount')
                    ->label('Сумма')
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('is_paid')
                    ->label('Оплачено')
                    ->boolean()
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
                TernaryFilter::make('is_paid')
                    ->label('Оплачено')
                    ->placeholder('Все')
                    ->trueLabel('Да')
                    ->falseLabel('Нет')
                    ->native(false),

                SelectFilter::make('status')
                    ->label('Статус')
                    ->native(false)
                    ->options(CatRequestStatusEnum::class),

                SelectFilter::make('type')
                    ->label('Тип заявки')
                    ->native(false)
                    ->options(CatRequestTypeEnum::class),

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
