<?php

namespace App\Lunar\Admin\Filament\Clusters\Taxes\Blocks;

use Redberry\PageBuilderPlugin\Abstracts\BaseBlock;

class Header extends BaseBlock
{
    public static function getBlockSchema(): array
    {
        return [
            // schema
        ];
    }

    public static function getView(): ?string
    {
        return 'lunar.blocks.header';
    }
}
