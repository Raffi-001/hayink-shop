<?php

namespace App\Filament\Designer\Resources\DesignImageResource\Pages;

use App\Filament\Designer\Resources\DesignImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesignImage extends EditRecord
{
    protected static string $resource = DesignImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
