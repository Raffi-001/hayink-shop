<?php
namespace App\Actions;

use App\Models\Artist;
use Lunar\Models\Product;

class GetArtists
{
    public function run()
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

}
