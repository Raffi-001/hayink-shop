<?php

namespace App\Filament\Resources\ProductInfoBlockResource\Pages;

use App\Filament\Resources\ProductInfoBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductInfoBlocks extends ListRecords
{
    protected static string $resource = ProductInfoBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
