<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $items;
    public $title;
    public $browseLink;
    public $perView;

    public function __construct($items, $title = null, $browseLink = null, $perView = 5)
    {
        $this->items = $items;
        $this->title = $title;
        $this->browseLink = $browseLink;
        $this->perView = $perView;
    }

    public function render()
    {
        return view('components.carousel');
    }
}
