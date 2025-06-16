<?php

namespace App\Livewire;

use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use PhpParser\Node\Scalar\String_;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductPage extends Component
{
    use FetchesUrls;

    /**
     * The selected option values.
     */
    public array $selectedOptionValues = [];

    public function mount($slug): void
    {
        $this->url = $this->fetchUrl(
            $slug,
            (new Product)->getMorphClass(),
            [
                'element.media',
                'element.variants.basePrices.currency',
                'element.variants.basePrices.priceable',
                'element.variants.values.option',
            ]
        );

        $this->selectedOptionValues = $this->productOptions->mapWithKeys(function ($data) {
            return [$data['option']->id => $data['values']->first()->id];
        })->toArray();

        if (! $this->variant) {
            abort(404);
        }
    }

    /**
     * Computed property to get variant.
     */
    public function getVariantProperty(): ProductVariant
    {
        return $this->product->variants->first(function ($variant) {
            return ! $variant->values->pluck('id')
                ->diff(
                    collect($this->selectedOptionValues)->values()
                )->count();
        });
    }

    /**
     * Computed property to return all available option values.
     */
    public function getProductOptionValuesProperty(): Collection
    {
        return $this->product->variants->pluck('values')->flatten();
    }

    /**
     * Computed propert to get available product options with values.
     */
    public function getProductOptionsProperty(): Collection
    {
        return $this->productOptionValues->unique('id')->groupBy('product_option_id')
            ->map(function ($values) {
                return [
                    'option' => $values->first()->option,
                    'values' => $values,
                ];
            })->values();
    }

    /**
     * Computed property to return product.
     */
    public function getProductProperty(): Product
    {
        return $this->url->element;
    }

    /**
     * Return all images for the product.
     */
    public function getImagesProperty(): Collection
    {
        return $this->product->media->sortBy('order_column');
    }

    /**
     * Computed property to return current image.
     */
    public function getImageProperty(): ?Media
    {
        if (count($this->variant->images)) {
            return $this->variant->images->first();
        }

        if ($primary = $this->images->first(fn ($media) => $media->getCustomProperty('primary'))) {
            return $primary;
        }

        return $this->images->first();
    }

    public function getLatestProductsProperty(): ?Collection
    {
        return \App\Models\Product::orderBy('id', 'desc')->limit(3)->get();
    }

    public function getRelatedProductsProperty(): ?Collection
    {
        $products = Product::whereHas('variants', function ($query) {
            $query->where('sku', 'like', 't-%');
        })->get();

        return $products;
    }

    public function getDesignersProductsProperty(): ?Collection
    {
        $products = Product::all();

        $designersProducts = [];

        foreach($products as $product) {
            if($product->translateAttribute('designer-name') === (string) $this->designerInfo['name']) {
                $designersProducts[] = $product;
            }
        }

        return collect($designersProducts);
    }

    public function getComparisonPriceProperty(): ?int
    {
        $prices = $this->variant->basePrices;

        // Assuming "comparison" prices are stored with a specific type or tag
        $comparisonPrice = $prices->first(function ($price) {
            return $price->price_type == 'compare_at'; // adjust key if necessary
        });

        return $comparisonPrice?->price;
    }

    public function getDesignerInfoProperty(): array
    {
        $imageUrl = (string) data_get($this, 'product.attribute_data.designer-image');
        $name = data_get($this, 'product.attribute_data.designer-name');
        $description = data_get($this, 'product.attribute_data.about-the-designer');
        $collectionLabel = data_get($this, 'product.attribute_data.collection');
        $collectionUrl = data_get($this, 'product.attribute_data.collection-url');

        return [
            'name' => $name,
            'image' => config('app.url') . '/' . $imageUrl,
            'description' => $description,
            'collectionLabel' => $collectionLabel,
            'collectionUrl' => config('app.url') . '/collections/' . $collectionUrl,
        ];
    }

    public function render(): View
    {
        return view('livewire.product-page');
    }
}
