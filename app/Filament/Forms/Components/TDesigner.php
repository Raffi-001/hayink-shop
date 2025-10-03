<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class TDesigner extends Field
{
    protected string $view = 'forms.components.tshirt-designer';

    /** @var string|Closure|null */
    protected string|Closure|null $background = null;

    /**
     * Set the background image URL for the canvas.
     */
    public function background(string|Closure|null $url): static
    {
        $this->background = $url;
        return $this;
    }

    /**
     * Resolve the background URL (supports closures).
     */
    public function getBackground(): ?string
    {
        return $this->evaluate($this->background);
    }
}
