<?php

namespace App\Filament\Designer\Pages;

use Filament\Pages\Page;

class TshirtDesigner extends Page
{
    protected static ?string $panel = 'designer';
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static string $view = 'filament.designer.pages.tshirt-designer';
    protected static ?string $title = 'T-Shirt Designer';
    protected static ?string $navigationLabel = 'T-Shirt Designer';
    protected static ?string $slug = 'tshirt-designer';
    protected static ?int $navigationSort = 10; // adjust menu order
}
