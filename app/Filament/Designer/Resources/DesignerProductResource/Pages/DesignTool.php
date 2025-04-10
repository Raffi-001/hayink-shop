<?php

namespace App\Filament\Designer\Resources\DesignerProductResource\Pages;

use App\Filament\Designer\Resources\DesignerProductResource;
use Filament\Resources\Pages\Page;

class DesignTool extends Page
{
    protected static string $resource = DesignerProductResource::class;

    protected static string $view = 'filament.designer.resources.designer-product-resource.pages.design-tool';

    protected ?string $maxContentWidth = 'full';
}
