<?php
namespace App\Livewire\CustomFields;

use App\Models\Artist;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Lunar\Admin\Support\FieldTypes\BaseFieldType;
use Lunar\Models\Attribute;

class SelectArtistFieldType extends BaseFieldType
{
    public static function getFilamentComponent(Attribute $attribute): Component
    {
        $options = Artist::all()->pluck('name', 'id');

        return Select::make($attribute->handle)
            ->options($options);
    }
}
