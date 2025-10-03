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
use Illuminate\Support\Facades\Http;
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

Route::get('/', Home::class)->name('home');

Route::get('/collections/{slug}', CollectionPage::class)->name('collection.view');

Route::get('/products', [\App\Http\Controllers\PagesController::class, 'products'])->name('products.index');

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


Route::get('/ameria-hook', function (Request $request) {
    $paymentId = $request->input('paymentID');

    if (!$paymentId) {
        return redirect()->route('checkout.view')->with('error', 'Payment ID missing.');
    }

    $payload = [
        "ClientID"  => "90d85bde-cc63-4ff2-b57d-1f2a6b4cdf22",
        "Username"  => "3d19541048",
        "Password"  => "lazY2k",
        "PaymentID" => $paymentId,
    ];

    $response = Http::withHeaders([
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
    ])->post('https://servicestest.ameriabank.am/VPOS/api/VPOS/ConfirmPayment', $payload);

    $data = $response->json();

    if (isset($data['ResponseCode']) && $data['ResponseCode'] == 1) {
        // Here you’d normally update your Order in DB

        return redirect()->route('checkout-success.view')
            ->with('success', 'Your payment was successful!');
    } else {
        return redirect()->route('checkout.view')
            ->with('error', 'Payment failed. Please try again.');
    }
})->name('ameria-hook');


Route::get('/ameria-pay', function () {
	$orderId = rand(3770005,3771000);

    $payload = [
        "ClientID"    => "90d85bde-cc63-4ff2-b57d-1f2a6b4cdf22",
        "Username"    => "3d19541048",
        "Password"    => "lazY2k",
        "Amount"      => 10.0,

        "OrderID"     => $orderId,
        "BackURL"     => "https://hayink.com/ameria-hook",
        "Description" => "abc",
        "Currency"    => "051",
    ];

    // Call AmeriaBank test InitPayment endpoint
    $response = Http::withHeaders([
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
    ])->post('https://servicestest.ameriabank.am/VPOS/api/VPOS/InitPayment', $payload);

    // Parse the response
    $data = $response->json();

    // Example: redirect user if success
    if (isset($data['PaymentID']) && $data['ResponseCode'] == 1) {
        return redirect()->away(
            "https://servicestest.ameriabank.am/VPOS/Payments/Pay?id={$data['PaymentID']}&lang=en"
        );
    }

})->name('ameria-pay');

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
