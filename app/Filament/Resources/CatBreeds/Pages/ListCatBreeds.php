<?php

namespace App\Filament\Resources\CatBreeds\Pages;

use App\Filament\Resources\CatBreeds\CatBreedResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCatBreeds extends ListRecords
{
    protected static string $resource = CatBreedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
