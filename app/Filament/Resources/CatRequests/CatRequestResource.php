<?php

namespace App\Filament\Resources\CatRequests;

use App\Filament\Resources\CatRequests\Pages\CreateCatRequest;
use App\Filament\Resources\CatRequests\Pages\EditCatRequest;
use App\Filament\Resources\CatRequests\Pages\ListCatRequests;
use App\Filament\Resources\CatRequests\Schemas\CatRequestForm;
use App\Filament\Resources\CatRequests\Tables\CatRequestsTable;
use App\Models\CatRequest;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CatRequestResource extends Resource
{
    protected static ?string $model = CatRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'заявка';

    protected static ?string $pluralModelLabel = 'заявки';

    protected static string|UnitEnum|null $navigationGroup = 'Коты';

    public static function form(Schema $schema): Schema
    {
        return CatRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CatRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCatRequests::route('/'),
            'create' => CreateCatRequest::route('/create'),
            'edit' => EditCatRequest::route('/{record}/edit'),
        ];
    }
}
