<?php

namespace App\Filament\Resources\DesignerProductResource\Pages;

use App\Filament\Resources\DesignerProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesignerProducts extends ListRecords
{
    protected static string $resource = DesignerProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
