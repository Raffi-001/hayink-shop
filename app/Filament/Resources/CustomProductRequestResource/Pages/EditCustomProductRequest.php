<?php

namespace App\Filament\Resources\CustomProductRequestResource\Pages;

use App\Filament\Resources\CustomProductRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomProductRequest extends EditRecord
{
    protected static string $resource = CustomProductRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
