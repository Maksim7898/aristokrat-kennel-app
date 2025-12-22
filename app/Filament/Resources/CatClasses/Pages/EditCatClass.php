<?php

namespace App\Filament\Resources\CatClasses\Pages;

use App\Filament\Resources\CatClasses\CatClassResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCatClass extends EditRecord
{
    protected static string $resource = CatClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
