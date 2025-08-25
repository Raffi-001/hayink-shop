<?php

namespace App\Filament\Resources\CustomProductRequestResource\Pages;

use App\Filament\Resources\CustomProductRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomProductRequest extends CreateRecord
{
    protected static string $resource = CustomProductRequestResource::class;
}
