<?php

namespace App\Filament\Resources\CatClasses;

use App\Filament\Resources\CatClasses\Pages\CreateCatClass;
use App\Filament\Resources\CatClasses\Pages\EditCatClass;
use App\Filament\Resources\CatClasses\Pages\ListCatClasses;
use App\Filament\Resources\CatClasses\Schemas\CatClassForm;
use App\Filament\Resources\CatClasses\Tables\CatClassesTable;
use App\Models\CatClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CatClassResource extends Resource
{
    protected static ?string $model = CatClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'класс';

    protected static ?string $pluralModelLabel = 'классы';

    protected static string|UnitEnum|null $navigationGroup = 'Коты';

    public static function form(Schema $schema): Schema
    {
        return CatClassForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CatClassesTable::configure($table);
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
            'index' => ListCatClasses::route('/'),
            'create' => CreateCatClass::route('/create'),
            'edit' => EditCatClass::route('/{record}/edit'),
        ];
    }
}
