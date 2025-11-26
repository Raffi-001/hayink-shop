<?php

use App\Http\Controllers\AmeriaPaymentController;
use App\Http\Controllers\PageController;
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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Lunar\Facades\CartSession;
use App\Services\Ehdm\Ehdm;
use App\Services\Ehdm\Transformers\OrderToHdmPayload;
use Lunar\Models\Order;

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

Route::get('/', Home::class)->name('home');

Route::get('/collections/{slug}', CollectionPage::class)->name('collection.view');

Route::get('/product-types/{productType}', \App\Livewire\ProductsPage::class)->name('products.index');
Route::get('/product-all', \App\Livewire\ProductsAll::class)->name('products.index');

Route::get('/products/{slug}', ProductPage::class)->name('product.view');

Route::get('search', SearchPage::class)->name('search.view');

Route::get('checkout', CheckoutPage::class)->name('checkout.view');

Route::get('checkout/success', \App\Livewire\CheckoutSuccessPage::class)->name('checkout-success.view');

Route::get('create-your-own', CreateYourOwnPage::class)->name('create-your-own.view');

Route::get('apply-as-an-artist', ApplyAsAnArtistPage::class)->name('apply-as-an-artist.view');

Route::get('contact', \App\Livewire\ContactUsPage::class)->name('contact-us.view');

Route::get('about', [\App\Http\Controllers\PagesController::class, 'about'])->name('pages.about');
Route::get('services', [\App\Http\Controllers\PagesController::class, 'services'])->name('pages.services');
Route::get('/artists', [\App\Http\Controllers\PagesController::class, 'artists'])->name('pages.artists');

Route::get('/thanks-1', [\App\Http\Controllers\ThanksController::class, 'thanks1'])->name('thanks.thanks1');
Route::get('/thanks-2', [\App\Http\Controllers\ThanksController::class, 'thanks2'])->name('thanks.thanks2');
Route::get('/thanks-3', [\App\Http\Controllers\ThanksController::class, 'thanks3'])->name('thanks.thanks3');

Route::get('/p/{slug}', [PageController::class, 'show'])->name('page.show');

Route::get('/ameria-hook-test', function () {
    return view('ameria-hook-test');
});

Route::get('/ameria-pay', [AmeriaPaymentController::class, 'pay'])
    ->name('ameria-pay');

Route::match(['get', 'post'], '/ameria-hook', [AmeriaPaymentController::class, 'hook'])
    ->name('ameria-hook');


if(! function_exists('createImageFromFile')) {
    function createImageFromFile(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("File not found: $filePath");
        }

        $imageType = exif_imagetype($filePath);

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($filePath);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($filePath);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($filePath);
            case IMAGETYPE_WEBP:
                return imagecreatefromwebp($filePath);
            default:
                throw new Exception("Unsupported image type: $filePath");
        }
    }
}

Route::post('/art/upload-design', function (Request $request) {
    $design = new \App\Models\DesignImage();
    $design->user_id = 1;
    $design->save();

    $design->addMediaFromRequest('images')
        ->usingName('My Custom File Name')
        ->toMediaCollection('design-images');

    $imagePath = $design->getFirstMediaPath('design-images'); // This is the local file path
    $image = createImageFromFile($imagePath);

    header('Content-Type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);

});

Route::get('/designs-catalog', function (Request $request) {
    // Eager-load media to avoid N+1
    $designs = DesignImage::with('media')
        // ->when($request->user(), fn($q) => $q->where('user_id', $request->user()->id))
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

