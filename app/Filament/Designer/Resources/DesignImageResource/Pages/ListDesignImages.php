<?php

namespace App\Filament\Designer\Resources\DesignImageResource\Pages;

use App\Filament\Designer\Resources\DesignImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesignImages extends ListRecords
{
    protected static string $resource = DesignImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
