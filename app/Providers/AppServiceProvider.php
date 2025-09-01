<?php

namespace App\Providers;

use App\Filament\Resources\ArtistApplicationResource;
use App\Filament\Resources\ArtistResource;
use App\Filament\Resources\CustomProductRequestResource;
use App\Filament\Resources\ProductInfoBlockResource;
use App\Livewire\CustomFields\SelectArtistField;
use App\Livewire\CustomFields\SelectArtistFieldType;
use App\Models\CustomProductRequest;
use App\Modifiers\ShippingModifier;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\Support\Facades\AttributeData;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Base\ShippingModifiers;
use Lunar\Shipping\ShippingPlugin;
use Lunar\Facades\Payments;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        LunarPanel::panel(function ($panel) {
            return $panel
                ->plugins([
                    new ShippingPlugin,
                ])
                ->resources([
                    ProductInfoBlockResource::class,
                    CustomProductRequestResource::class,
                    ArtistApplicationResource::class,
                    ArtistResource::class,
                ]);
        })->register();

        Payments::extend('custom', function ($app) {
            return $app->make(CustomPayment::class);
        });

        AttributeData::registerFieldType(SelectArtistField::class, SelectArtistFieldType::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ShippingModifiers $shippingModifiers): void
    {
	if($this->app->environment('production')) {
	    \URL::forceScheme('https');
	}

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
