<?php

use App\Livewire\ApplyAsAnArtistPage;
use App\Livewire\CheckoutPage;
use App\Livewire\CreateYourOwnPage;
use App\Livewire\CollectionPage;
use App\Livewire\Home;
use App\Livewire\ProductPage;
use App\Livewire\SearchPage;
use App\Models\DesignImage;
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Home::class);

Route::get('/collections/{slug}', CollectionPage::class)->name('collection.view');

Route::get('/products/{slug}', ProductPage::class)->name('product.view');

Route::get('search', SearchPage::class)->name('search.view');

Route::get('checkout', CheckoutPage::class)->name('checkout.view');

Route::get('checkout/success', CreateYourOwnPage::class)->name('checkout-success.view');

Route::get('create-your-own', CreateYourOwnPage::class)->name('create-your-own.view');

Route::get('apply-as-an-artist', ApplyAsAnArtistPage::class)->name('apply-as-an-artist.view');

Route::get('about', [\App\Http\Controllers\PagesController::class, 'about'])->name('pages.about');
Route::get('services', [\App\Http\Controllers\PagesController::class, 'services'])->name('pages.services');
Route::get('/artists', [\App\Http\Controllers\PagesController::class, 'artists'])->name('pages.artists');

Route::get('/ameria-hook', function () {
    return 'paid';
})->name('ameria-hook');

Route::get('/ameria-pay', function () {
    $initPayment = ameriabank()->pay(10, rand(3770001, 3771000), []);

    if($initPayment['status'] === "SUCCESS") {
        // If you need to store payment id in your database
        // For get full response use: $initPayment['response'];
        $paymentId = $initPayment['paymentId'];
        // Redirect to AmeriaBank payment interface
        return redirect($initPayment['redirectUrl']);
    }
})->name('ameria-pay');

Route::post('/art/upload-design', function (Request $request) {
    $design = new \App\Models\DesignImage();
    $design->user_id = 1;
    $design->save();

    $design->addMediaFromRequest('images')
        ->usingName('My Custom File Name')
        ->toMediaCollection('design-images');

    $imagePath = $design->getFirstMediaPath('design-images'); // This is the local file path
    $image = imagecreatefromjpeg($imagePath);

    header('Content-Type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);

});

Route::get('/designs-catalog', function (Request $request) {
    // Eager-load media to avoid N+1
    $designs = DesignImage::with('media')
        ->when($request->user(), fn($q) => $q->where('user_id', $request->user()->id))
        ->orderByDesc('id')
        ->get();

    // Build the designs array items
    $designItems = $designs->map(function (DesignImage $d) {
        $media = $d->getFirstMedia('design-images');

        $source = $media ? $media->getUrl() : null;

        // Prefer a 'thumb' conversion if it exists; else fall back to original
        $thumb = $media
            ? ($media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : $media->getUrl())
            : null;

        // If you don't have a `parameters` column yet, return an empty object
        $parameters = $d->parameters ?? (object)[];

        return [
            'title'      => $d->title,
            'source'     => $source,
            'parameters' => $parameters,
            'thumbnail'  => $thumb,
        ];
    })->values();

    // Use the first design's image as the section/category thumbnail (or null)
    $firstMedia = optional($designs->first())->getFirstMedia('design-images');
    $fallbackThumb = $firstMedia ? $firstMedia->getUrl() : null;

    $payload = [[
        'title'     => 'Designs',
        'thumbnail' => $fallbackThumb,
        'category'  => [[
            'title'     => 'All',
            'thumbnail' => $fallbackThumb,
            'designs'   => $designItems,
        ]],
    ]];

    return response()->json($payload);
});
