<?php

namespace App\Filament\Resources\CatRequests\Pages;

use App\Filament\Resources\CatRequests\CatRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCatRequests extends ListRecords
{
    protected static string $resource = CatRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
