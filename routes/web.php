<?php

use App\Livewire\ApplyAsAnArtistPage;
use App\Livewire\CheckoutPage;
use App\Livewire\CreateYourOwnPage;
use App\Livewire\CollectionPage;
use App\Livewire\Home;
use App\Livewire\ProductPage;
use App\Livewire\SearchPage;
use Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS;
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

    dd($initPayment['response']);

    if($initPayment['status'] === "SUCCESS") {
        // If you need to store payment id in your database
        // For get full response use: $initPayment['response'];
        $paymentId = $initPayment['paymentId'];
        // Redirect to AmeriaBank payment interface
        return redirect($initPayment['redirectUrl']);
    }
})->name('ameria-pay');
