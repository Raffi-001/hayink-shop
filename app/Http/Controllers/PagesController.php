<?php

namespace App\Http\Controllers;

use App\Actions\GetArtists;
use Illuminate\Http\Request;
use Lunar\Models\CollectionGroup;

class PagesController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function products()
    {
        $products = \Lunar\Models\Product::paginate(50);

        return view('products', [
            'products' => $products,
        ]);

    }

    public function artists(GetArtists $getArtists)
    {
        $group = CollectionGroup::where('handle', 'artists-collections')->first();

        return view('artists', [
            'artists' => $getArtists->run(),
        ]);
    }
}
