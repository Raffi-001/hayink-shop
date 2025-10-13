<?php

namespace App\Livewire;

use App\Models\Product;
use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\ProductType;
use Lunar\Models\ProductType as ProductTypeModel;

class ProductsPage extends Component
{
    use FetchesUrls;

    protected ProductType $productType;

    public function mount(ProductTypeModel $productType): void
    {
        $this->productType = $productType;
    }

    public function getProductTypeProperty()
    {
        return $this->productType;
    }

    public function getTitleProperty()
    {
        return $this->productType->name;
    }

    public function getProductsProperty(): mixed
    {
        return $this->productType->products;
    }

    public function render(): View
    {
        return view('livewire.products-page');
    }
}
