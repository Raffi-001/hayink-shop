<?php

namespace App\Providers;

use App\Filament\Resources\DesignerProductResource;
use App\Filament\Resources\ArtistApplicationResource;
use App\Filament\Resources\ArtistResource;
use App\Filament\Resources\CustomProductRequestResource;
use App\Filament\Resources\PageResource;
use App\Filament\Resources\ProductInfoBlockResource;
use App\Livewire\CustomFields\SelectArtistField;
use App\Livewire\CustomFields\SelectArtistFieldType;
use App\Lunar\Admin\Filament\Extensions\ProductListExtension;
use App\Models\CustomProductRequest;
use App\Modifiers\ShippingModifier;
use App\PaymentTypes\AmeriaPayment;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Lunar\Admin\Filament\Resources\ProductResource;
use Lunar\Admin\Filament\Resources\ProductResource\Pages\ListProducts;
use Lunar\Admin\Support\Facades\AttributeData;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Base\ShippingModifiers;
use Lunar\Facades\FieldTypeManifest;
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
                    DesignerProductResource::class,
                    CustomProductRequestResource::class,
                    ArtistApplicationResource::class,
                    ArtistResource::class,
                    PageResource::class,
                ]);
        })->register();

        Payments::extend('ameriabank', function ($app) {
            return $app->make(AmeriaPayment::class);
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

        Livewire::addPersistentMiddleware([
            \App\Http\Middleware\SetLocale::class,
        ]);

        LunarPanel::extensions([
            ProductResource::class => ProductListExtension::class,
        ]);


    }
}
