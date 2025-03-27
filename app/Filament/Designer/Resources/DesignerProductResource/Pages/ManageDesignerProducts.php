<?php

namespace App\Filament\Designer\Resources\DesignerProductResource\Pages;

use App\Filament\Designer\Resources\DesignerProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDesignerProducts extends ManageRecords
{
    protected static string $resource = DesignerProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
