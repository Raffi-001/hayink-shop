<?php

namespace App\Models;

use Illuminate\Support\Str;
use Lunar\Models\Product as LunarProduct;

class Product extends LunarProduct
{
    public function getArtistAttribute(): ?\App\Models\Artist
    {
        $artistField = $this->attribute_data['artist'] ?? null;

        if (! $artistField || blank($artistField->getValue())) {
            return null;
        }

        return \App\Models\Artist::find($artistField->getValue());
    }
}
