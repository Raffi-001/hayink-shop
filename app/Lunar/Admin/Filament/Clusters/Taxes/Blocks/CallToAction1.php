<?php

namespace App\Lunar\Admin\Filament\Clusters\Taxes\Blocks;

use Redberry\PageBuilderPlugin\Abstracts\BaseBlock;

class CallToAction1 extends BaseBlock
{
    public static function getBlockSchema(): array
    {
        return [
            // schema
        ];
    }

    public static function getView(): ?string
    {
        return 'lunar.blocks.call-to-action1';
    }
}
