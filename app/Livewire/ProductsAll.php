<?php

namespace App\Livewire;

use Lunar\Models\Product;
use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\ProductType;
use Lunar\Models\ProductType as ProductTypeModel;

class ProductsAll extends Component
{
    use FetchesUrls;

    public function getTitleProperty()
    {
        return 'Products';
    }

    public function getProductsProperty(): mixed
    {
        return Product::all();
    }

    public function render(): View
    {
        return view('livewire.products-page');
    }
}
