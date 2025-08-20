<?php

namespace App\Filament\Resources\ProductInfoBlockResource\Pages;

use App\Filament\Resources\ProductInfoBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductInfoBlock extends EditRecord
{
    protected static string $resource = ProductInfoBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
