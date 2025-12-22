<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('author.full_name')
                    ->label('Автор')
                    ->searchable(['full_name', 'email'])
                    ->sortable()
                    ->description(fn (Post $record): string => $record->author->email)
                    ->toggleable(),

                TextColumn::make('slug')
                    ->label('ЧПУ')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('short_title')
                    ->label('Краткий заголовок')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('category.name')
                    ->label('Категория')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('is_published')
                    ->label('Опубликован')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),

                TextColumn:: make('views_count')
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
                SelectFilter::make('post_category_id')
                    ->label('Категория')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->native(false)
                    ->preload(),

                SelectFilter::make('user_id')
                    ->label('Автор')
                    ->relationship('author', 'full_name')
                    ->searchable(['full_name', 'email'])
                    ->native(false)
                    ->preload(),

                TernaryFilter::make('is_published')
                    ->label('Опубликован')
                    ->placeholder('Все')
                    ->trueLabel('Да')
                    ->falseLabel('Нет')
                    ->native(false),
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
