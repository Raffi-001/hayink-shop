<?php
namespace App\Livewire\CustomFields;

use Lunar\FieldTypes\Dropdown;

class SelectArtistField extends Dropdown
{
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getConfig(): array
    {
        return [];
    }

}
