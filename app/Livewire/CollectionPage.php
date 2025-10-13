<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection as CollectionModel;

class CollectionPage extends Component
{
    use FetchesUrls;

    public function mount(string $slug): void
    {
        $this->url = $this->fetchUrl(
            $slug,
            (new CollectionModel)->getMorphClass(),
            [
                'element.thumbnail',
                'element.products.variants.basePrices',
                'element.products.defaultUrl',
            ]
        );


        if (! $this->url) {
            abort(404);
        }
    }

    /**
     * Computed property to return the collection.
     */
    public function getCollectionProperty(): mixed
    {
        return $this->url->element;
    }

    public function getDesignerProperty(): mixed
    {
        $collectionSlug = $this->url->attributesToArray()['slug'];

        $designer = Artist::where('slug', $collectionSlug)->first();

        if($designer) {
            return [
                'name' => $designer->name,
                'about' => $designer->about,
                'image' => $designer->getFirstMediaUrl('artist-avatars'),
            ];
        }

        return [
            'name' => null,
            'about' => null,
            'image' => null,
        ];

    }

    public function render(): View
    {
        return view('livewire.collection-page');
    }
}
