<?php
namespace App\Enums;

enum ProductInfoType: string
{
    case SizeChart = 'size_chart';
    case Care = 'care';

    public function getLabel(): string
    {
        return match ($this) {
            self::SizeChart => 'Size Chart',
            self::Care => 'Material & Care Instructions',
        };
    }
}
