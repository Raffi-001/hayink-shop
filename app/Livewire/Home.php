<?php

namespace App\Livewire;

use App\Models\Artist;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;
use Lunar\Models\Product;
use Lunar\Models\Url;

class Home extends Component
{
    /**
     * Return the sale collection.
     */
    public function getSaleCollectionProperty(): Collection | null
    {
        return Url::whereElementType((new Collection)->getMorphClass())->whereSlug('sale')->first()?->element ?? null;
    }

    /**
     * Return all images in sale collection.
     */
    public function getSaleCollectionImagesProperty()
    {
        if (! $this->getSaleCollectionProperty()) {
            return null;
        }

        $collectionProducts = $this->getSaleCollectionProperty()
            ->products()->inRandomOrder()->limit(4)->get();

        $saleImages = $collectionProducts->map(function ($product) {
            return $product->thumbnail;
        });

        return $saleImages->chunk(2);
    }

    /**
     * Return a random collection.
     */
    public function getRandomCollectionProperty(): ?Collection
    {
        $collections = Url::whereElementType((new Collection)->getMorphClass());

        if ($this->getSaleCollectionProperty()) {
            $collections = $collections->where('element_id', '!=', $this->getSaleCollectionProperty()?->id);
        }

        return $collections->inRandomOrder()->first()?->element;
    }

    public function getFrontPageCollectionsProperty()
    {
        return CollectionGroup::where('handle', 'front-page-collections')->first()->collections()->with(['defaultUrl'])->get();
    }

    public function getArtistsProperty()
    {
        return Artist::all()->map(function ($artist) {
            return (object) [
                'name' => $artist->name,
                'avatar' => $artist->getFirstMediaUrl('artist-avatars'),
                'collection' => '/collections/' . $artist->slug,
                'product_count' => Product::whereJsonContains('attribute_data->artist->value', (string) $artist->id)->get()->count(),
            ];
        });
    }

    public function render(): View
    {
        return view('livewire.home');
    }
}
