<?php

namespace App\Filament\Resources\Cats;

use App\Filament\Resources\Cats\Pages\CreateCat;
use App\Filament\Resources\Cats\Pages\EditCat;
use App\Filament\Resources\Cats\Pages\ListCats;
use App\Filament\Resources\Cats\Schemas\CatForm;
use App\Filament\Resources\Cats\Tables\CatsTable;
use App\Models\Cat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CatResource extends Resource
{
    protected static ?string $model = Cat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'кот';

    protected static ?string $pluralModelLabel = 'коты';

    protected static string|UnitEnum|null $navigationGroup = 'Коты';

    public static function form(Schema $schema): Schema
    {
        return CatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CatsTable::configure($table);
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
            'index' => ListCats::route('/'),
            'create' => CreateCat::route('/create'),
            'edit' => EditCat::route('/{record}/edit'),
        ];
    }
}
