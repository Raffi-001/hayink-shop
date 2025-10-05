<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;

class Navigation extends Component
{
    /**
     * The search term for the search input.
     *
     * @var string
     */
    public $term = null;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * Return the collections in a tree.
     */
    public function getCollectionsProperty()
    {
        $group = CollectionGroup::where('handle', 'main')->first();

        if (!$group) {
            return collect(); // fallback in case group doesn't exist
        }

        // Filter collections that have at least one product
        return $group->collections()
            // ->whereHas('products') // Only collections with products
            // ->with('defaultUrl', 'products') // Eager load if needed
            ->get()
            ->toTree();
    }

    public function render(): View
    {
        return view('livewire.components.navigation');
    }
}
