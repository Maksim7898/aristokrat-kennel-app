<?php

namespace App\Filament\Resources\CatRequests\Pages;

use App\Filament\Resources\CatRequests\CatRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCatRequest extends EditRecord
{
    protected static string $resource = CatRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
