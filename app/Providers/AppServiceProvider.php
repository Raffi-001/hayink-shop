<?php

namespace App\Providers;

use App\Modifiers\ShippingModifier;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Base\ShippingModifiers;
use Lunar\Shipping\ShippingPlugin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        LunarPanel::panel(
            fn ($panel) => $panel->plugins([
                new ShippingPlugin,
            ])
        )
            ->register();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ShippingModifiers $shippingModifiers): void
    {
        $shippingModifiers->add(
            ShippingModifier::class
        );

        \Lunar\Facades\ModelManifest::replace(
            \Lunar\Models\Contracts\Product::class,
            \App\Models\Product::class,
            // \App\Models\CustomProduct::class,
        );

        FilamentAsset::register([
            // Css::make('custom', __DIR__ . '/../../resources/fpd-js/dist/css/FancyProductDesigner.min.css'),
            // Js::make('fabric', __DIR__ . '/../../resources/fpd-js/dist/js/fabric.js'),
            // Js::make('fancyproductdesigner', __DIR__ . '/../../resources/fpd-js/dist/js/FancyProductDesigner.js'),
            // Js::make('fpdinit', __DIR__ . '/../../resources/fpd-js/dist/js/fpdinit.js'),
        ]);
    }
}
