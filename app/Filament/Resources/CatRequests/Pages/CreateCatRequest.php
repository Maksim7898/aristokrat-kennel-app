<?php

namespace App\Filament\Resources\CatRequests\Pages;

use App\Filament\Resources\CatRequests\CatRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCatRequest extends CreateRecord
{
    protected static string $resource = CatRequestResource::class;
}
