<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Lunar\Models\Price;
use Lunar\Models\ProductVariant;

class ProductComparisonPrice extends Component
{
    public ?Price $price = null;

    public ?ProductVariant $variant = null;

    public function __construct($product = null, $variant = null)
    {
        $this->variant = $variant ?: $product->variants->first();

        $this->price = $this->variant
            ->prices()
            ->whereHas('priceType', fn ($query) => $query->where('handle', 'rrp')) // adjust 'rrp' as needed
            ->first();
    }

    public function render(): View
    {
        return view('components.product-comparison-price');
    }
}
