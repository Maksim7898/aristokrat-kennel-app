<?php

namespace App\Filament\Resources\CatClasses\Pages;

use App\Filament\Resources\CatClasses\CatClassResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCatClass extends CreateRecord
{
    protected static string $resource = CatClassResource::class;
}
