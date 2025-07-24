<?php

namespace App\Http\Controllers;

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
    public function artists()
    {
        $artists = [
            [
                'name' => 'Evolve',
                'image' => '',
                'about' => ''
            ],
            [
                'name' => 'Chechu',
                'image' => '',
                'about' => ''
            ],
        ];

        $group = CollectionGroup::where('handle', 'artists-collections')->first();

        return view('artists', [
            'collections' => $group->collections,
        ]);
    }
}
