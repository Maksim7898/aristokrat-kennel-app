<?php

namespace App\Filament\Resources\CatClasses\Pages;

use App\Filament\Resources\CatClasses\CatClassResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCatClasses extends ListRecords
{
    protected static string $resource = CatClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
