<?php

namespace App\Filament\Resources\CatBreeds\Pages;

use App\Filament\Resources\CatBreeds\CatBreedResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCatBreed extends EditRecord
{
    protected static string $resource = CatBreedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
