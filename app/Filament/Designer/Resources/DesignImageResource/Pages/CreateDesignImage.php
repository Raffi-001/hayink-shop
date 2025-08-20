<?php

namespace App\Filament\Designer\Resources\DesignImageResource\Pages;

use App\Filament\Designer\Resources\DesignImageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDesignImage extends CreateRecord
{
    protected static string $resource = DesignImageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
