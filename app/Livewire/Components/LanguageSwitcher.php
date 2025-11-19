<?php
namespace App\Livewire\Components;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $current;

    public array $languages;

    public function mount()
    {
        $this->languages = config('languages');
        $this->current = app()->getLocale();
    }

    public function switch($locale)
    {
        $this->current = $locale;

        // cookie('app_locale', $locale, 60 * 24 * 30);

        app()->setLocale($locale);

        Cookie::queue('app_locale', $locale, 60 * 24 * 30);

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.components.language-switcher');
    }
}
