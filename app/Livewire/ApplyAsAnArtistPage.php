<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Order;

class ApplyAsAnArtistPage extends Component
{
    public $positions = [
        'medium-back' => [
            'img' => 'images/positioning-1.png',
        ],
        'full-front' => [
            'img' => 'images/positioning-2.png',
        ],
        'left-chest' => [
            'img' => 'images/positioning-3.png',
        ],
        'left-sleeve' => [
            'img' => 'images/positioning-4.png',
        ],
        'right-sleeve' => [
            'img' => 'images/positioning-5.png',
        ],
        'full-back' => [
            'img' => 'images/positioning-6.png',
        ],
    ];

    public $selectedPositions = [];

    public function togglePosition($key)
    {
        if (in_array($key, $this->selectedPositions)) {
            // Unselect it
            $this->selectedPositions = array_filter(
                $this->selectedPositions,
                fn ($selected) => $selected !== $key
            );
        } else {
            // Select it
            $this->selectedPositions[] = $key;
        }
    }

    public function render(): View
    {
        return view('livewire.apply-as-an-artist-page');
    }
}
