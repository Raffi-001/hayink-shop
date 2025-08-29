<?php
namespace App\Livewire\CustomFields;

use Lunar\Admin\Support\Synthesizers\AbstractFieldSynth;

class SelectArtistFieldSynth extends AbstractFieldSynth
{
    public static $key = 'lunar_select_artist_field';

    protected static $targetClass = SelectArtistField::class;
}
