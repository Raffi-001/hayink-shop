<?php

namespace App\Filament\Resources\DesignerProductResource\Pages;

use App\Filament\Resources\DesignerProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesignerProduct extends EditRecord
{
    protected static string $resource = DesignerProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['colors', 'mockups'] as $key) {
            if (is_string($data[$key] ?? null)) {
                $data[$key] = json_decode($data[$key], true) ?? [];
            }
        }
        return $data;
    }

}
