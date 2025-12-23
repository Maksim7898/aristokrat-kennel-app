<?php

namespace App\Filament\Resources\CatBreeds;

use App\Filament\Resources\CatBreeds\Pages\CreateCatBreed;
use App\Filament\Resources\CatBreeds\Pages\EditCatBreed;
use App\Filament\Resources\CatBreeds\Pages\ListCatBreeds;
use App\Filament\Resources\CatBreeds\Schemas\CatBreedForm;
use App\Filament\Resources\CatBreeds\Tables\CatBreedsTable;
use App\Models\CatBreed;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CatBreedResource extends Resource
{
    protected static ?string $model = CatBreed::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'порода';

    protected static ?string $pluralModelLabel = 'породы';

    protected static string|UnitEnum|null $navigationGroup = 'Коты';

    public static function form(Schema $schema): Schema
    {
        return CatBreedForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CatBreedsTable::configure($table);
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
            'index' => ListCatBreeds::route('/'),
            'create' => CreateCatBreed::route('/create'),
            'edit' => EditCatBreed::route('/{record}/edit'),
        ];
    }
}
