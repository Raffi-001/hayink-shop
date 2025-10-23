<?php

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

Route::match(['get', 'post'], '/ameria-hook', function (Request $request) {
    \Log::info('Payment Request', $request->all());
    $paymentId = $request->input('paymentID');
    $orderId = $request->input('orderID');

    // Log webhook request for debugging
    \Log::info('Ameria webhook received', [
        'payment_id' => $paymentId,
        'order_id' => $orderId,
        'method' => $request->method(),
        'all_input' => $request->all()
    ]);

    if (!$paymentId) {
        \Log::warning('Ameria webhook missing payment ID', ['request_data' => $request->all()]);
        return redirect()->route('checkout.view')->with('error', 'Payment ID missing.');
    }

    $payload = [
        "ClientID"  => "90d85bde-cc63-4ff2-b57d-1f2a6b4cdf22",
        "Username"  => "3d19541048",
        "Password"  => "lazY2k",
        "PaymentID" => $paymentId,
    ];

    // Use GetPaymentDetails instead of ConfirmPayment to get actual payment information
    $response = Http::withHeaders([
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
    ])->post('https://servicestest.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails', [
        'PaymentID' => $paymentId,
        'Username'  => '3d19541048',
        'Password'  => 'lazY2k',
    ]);

    $data = $response->json();

    // Log the response for debugging
    \Log::info('Ameria payment details response', [
        'payment_id' => $paymentId,
        'response' => $data
    ]);

    // Check if payment is successful (response code 00 means approved)
    $isPaymentApproved = ($request->input('resposneCode') === '00' || $request->input('responseCode') === '00') ||
                        (isset($data['ResponseCode']) && $data['ResponseCode'] == '00');

    if ($isPaymentApproved) {
        // Find order by payment ID (order should already exist from /ameria-pay)
        //$order = \Lunar\Models\Order::whereJsonContains('meta->ameria_payment_id', $paymentId)->first();
        $order = \Lunar\Models\Order::where('reference', 'AMERIA-' . $orderId)->first();

        \Log::info('Webhook order lookup', [
            'payment_id' => $paymentId,
            'order_found' => $order ? true : false,
            'order_id' => $order ? $order->id : null,
            'search_query' => 'meta->ameria_payment_id = ' . $paymentId,
        ]);

        if (!$order) {
            \Log::error('Order not found for payment', [
                'payment_id' => $paymentId,
                'order_id' => $orderId,
                'amount' => $data['Amount'] ?? 0,
            ]);

            return redirect()->route('checkout.view')
                ->with('error', 'Order not found. Please contact support.');
        }

        // Check if order is already processed to prevent duplicates
        if ($order->status === 'payment-received') {
            \Log::info('Order already processed', ['order_id' => $order->id, 'payment_id' => $paymentId]);
            return redirect()->route('checkout-success.view')
                ->with('success', 'Your payment was already processed successfully!');
        }

        if ($order) {
            try {
                // Update order status to payment received
                $existingMeta = $order->meta ? (array) $order->meta : [];
                $order->update([
                    'status' => 'payment-received',
                    'meta' => array_merge($existingMeta, [
                        'ameria_payment_id' => $paymentId,
                        'ameria_payment_confirmed' => true,
                        'ameria_payment_confirmed_at' => now(),
                        'ameria_response_data' => $data,
                    ])
                ]);

                // Create a transaction record using Lunar's native method
                $order->transactions()->create([
                    'parent_transaction_id' => null,
                    'type' => 'capture',
                    'amount' => $order->total,
                    'reference' => $paymentId,
                    'status' => 'success',
                    'success' => true,
                    'driver' => 'offline',
                    'card_type' => 'unknown',
                    'last_four' => '****',
                    'notes' => 'Payment confirmed via Ameria webhook',
                    'meta' => $data,
                ]);

                \Log::info('Order updated successfully', [
                    'order_id' => $order->id,
                    'payment_id' => $paymentId,
                    'status' => 'payment-received'
                ]);

                return redirect()->route('checkout-success.view')
                    ->with('success', 'Your payment was successful!');

            } catch (\Exception $e) {
                \Log::error('Failed to update order', [
                    'order_id' => $order->id,
                    'payment_id' => $paymentId,
                    'error' => $e->getMessage()
                ]);

                return redirect()->route('checkout.view')
                    ->with('error', 'Payment was successful but there was an issue updating the order. Please contact support.');
            }
        } else {
            \Log::error('No order found or created for payment', [
                'payment_id' => $paymentId,
                'order_id' => $orderId
            ]);

            return redirect()->route('checkout.view')
                ->with('error', 'Payment was successful but we could not find or create your order. Please contact support.');
        }
    } else {
        // Log failed payment attempt
        \Log::warning('Ameria payment confirmation failed', [
            'payment_id' => $paymentId,
            'order_id' => $orderId,
            'response' => $data,
            'request_data' => $request->all()
        ]);

        // Check if payment was actually successful but confirmation failed
        $isPaymentSuccess = ($request->input('resposneCode') === '00' || $request->input('responseCode') === '00');

        if ($isPaymentSuccess) {
            // Payment was successful but confirmation API failed - still process the order
            \Log::info('Payment was successful but confirmation failed, processing anyway', [
                'payment_id' => $paymentId,
                'order_id' => $orderId
            ]);

            // Find or create order (same logic as success case)
            $order = null;

            if ($orderId) {
                $order = \Lunar\Models\Order::find($orderId);
            }

            if (!$order) {
                $order = \Lunar\Models\Order::whereJsonContains('meta->ameria_payment_id', $paymentId)->first();
            }

            if (!$order) {
                $transaction = \Lunar\Models\Transaction::where('reference', $paymentId)->first();
                if ($transaction) {
                    $order = $transaction->order;
                }
            }

            if ($order) {
                try {
                    $existingMeta = $order->meta ? (array) $order->meta : [];
                    $order->update([
                        'status' => 'payment-received',
                        'meta' => array_merge($existingMeta, [
                            'ameria_payment_id' => $paymentId,
                            'ameria_payment_confirmed' => true,
                            'ameria_payment_confirmed_at' => now(),
                            'ameria_response_data' => $data,
                        ])
                    ]);

                    $order->transactions()->create([
                        'parent_transaction_id' => null,
                        'type' => 'capture',
                        'amount' => $order->total,
                        'reference' => $paymentId,
                        'status' => 'success',
                        'success' => true,
                        'driver' => 'offline',
                        'card_type' => 'unknown',
                        'last_four' => '****',
                        'notes' => 'Payment confirmed via Ameria webhook (confirmation API failed)',
                        'meta' => $data,
                    ]);

                    return redirect()->route('checkout-success.view')
                        ->with('success', 'Your payment was successful!');

                } catch (\Exception $e) {
                    \Log::error('Failed to update order after payment success', [
                        'order_id' => $order->id,
                        'payment_id' => $paymentId,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        return redirect()->route('checkout.view')
            ->with('error', 'Payment failed. Please try again.');
    }
})->name('ameria-hook');


Route::get('/ameria-pay', function () {
    $cart = CartSession::current();

    if (!$cart || $cart->lines->isEmpty()) {
        return redirect()->route('checkout.view')
            ->with('error', 'Your cart is empty.');
    }

    // Calculate totals to ensure numeric values
    $cart->calculate();

    // Get default channel and currency
    $channel = \Lunar\Models\Channel::getDefault();
    $currency = \Lunar\Models\Currency::getDefault();

    // Debug cart values
    \Log::info('Cart values before order creation', [
        'cart_id' => $cart->id,
        'sub_total' => $cart->subTotal->value,
        'total' => $cart->total->value,
        'discount_total' => $cart->discountTotal->value,
        'shipping_total' => $cart->shippingTotal->value,
        'tax_total' => $cart->taxTotal->value,
        'channel_id' => $channel->id,
        'currency_code' => $currency->code,
    ]);

    // Create the order using raw database insert to ensure all fields are included
    $orderId = DB::table('lunar_orders')->insertGetId([
        'status' => 'awaiting-payment',
        'reference' => 'AMERIA-' . time(),
        'sub_total' => $cart->subTotal->value,
        'total' => $cart->total->value,
        'channel_id' => $channel->id,
        'currency_code' => $currency->code,
        'discount_total' => $cart->discountTotal->value,
        'shipping_total' => $cart->shippingTotal->value,
        'tax_total' => $cart->taxTotal->value,
        'discount_breakdown' => json_encode([]),
        'shipping_breakdown' => json_encode([]),
        'tax_breakdown' => json_encode([]),
        'meta' => json_encode([
            'created_from_cart' => true,
            'cart_id' => $cart->id,
        ]),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Get the created order
    $order = \Lunar\Models\Order::find($orderId);

    // Create order lines from cart lines using raw database insert
    foreach ($cart->lines as $cartLine) {
        DB::table('lunar_order_lines')->insert([
            'purchasable_type' => $cartLine->purchasable_type,
            'purchasable_id' => $cartLine->purchasable_id,
            'type' => $cartLine->type ?? 'physical',
            'description' => $cartLine->description ?? 'Product',
            'option' => $cartLine->option,
            'identifier' => $cartLine->identifier ?? 'product-' . $cartLine->purchasable_id,
            'unit_price' => $cartLine->unit_price ?? 0,
            'unit_quantity' => $cartLine->unit_quantity ?? 1,
            'quantity' => $cartLine->quantity ?? 1,
            'sub_total' => $cartLine->sub_total ?? 0,
            'discount_total' => $cartLine->discount_total ?? 0,
            'tax_total' => $cartLine->tax_total ?? 0,
            'total' => $cartLine->total ?? 0,
            'tax_breakdown' => json_encode([]),
            'meta' => json_encode($cartLine->meta ?? []),
            'order_id' => $orderId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Create order addresses from cart addresses
    foreach ($cart->addresses as $cartAddress) {
        $order->addresses()->create([
            'type' => $cartAddress->type,
            'title' => $cartAddress->title,
            'first_name' => $cartAddress->first_name,
            'last_name' => $cartAddress->last_name,
            'company_name' => $cartAddress->company_name,
            'line_one' => $cartAddress->line_one,
            'line_two' => $cartAddress->line_two,
            'line_three' => $cartAddress->line_three,
            'city' => $cartAddress->city,
            'state' => $cartAddress->state,
            'postcode' => $cartAddress->postcode,
            'country_id' => $cartAddress->country_id,
            'contact_email' => $cartAddress->contact_email,
            'contact_phone' => $cartAddress->contact_phone,
        ]);
    }

    // Clear the cart
    $cart->delete();

    // For local environment, use Ameria Bank's recommended order ID range and test amount
    if (app()->environment('local')) {
        $orderId = rand(3770005, 3771000); // Ameria Bank's recommended range
        $amountAMD = 10.00; // 10 drams in decimal format
    } else {
        $orderId = (int) $order->id; // Use actual order ID in production
        $amountAMD = $order->total->value / 100; // Convert minor units to float
    }


    // Payment initialization request (InitPayment)
    $payload = [
        'ClientID'    => config('services.ameria.client_id'),
        'Username'    => config('services.ameria.username'),
        'Password'    => config('services.ameria.password'),
        'Amount'      => $amountAMD,
        'OrderID'     => $orderId,
        'BackURL'     => route('ameria-hook'),
        'Description' => "Order #{$orderId}",
        'Currency'    => '051', // AMD
    ];

    $response = Http::acceptJson()
        ->post('https://servicestest.ameriabank.am/VPOS/api/VPOS/InitPayment', $payload);

    $data = $response->json();

    Log::info('Ameria InitPayment Response', $data);

    if (($data['ResponseCode'] ?? 0) == 1 && !empty($data['PaymentID'])) {
        // Update order with payment ID for webhook lookup
        $existingMeta = (array) $order->meta;
        $order->update([
            'reference' => "AMERIA-{$orderId}",
            'meta' => array_merge($existingMeta, [
                'ameria_payment_id' => $data['PaymentID'],
                'ameria_initiated_at' => now(),
            ]),
        ]);

        \Log::info('Order updated with payment ID', [
            'order_id' => $order->id,
            'payment_id' => $data['PaymentID'],
            'order_reference' => $order->reference,
        ]);

        $paymentUrl = "https://servicestest.ameriabank.am/VPOS/Payments/Pay?id={$data['PaymentID']}&lang=en";
        return redirect()->away($paymentUrl);
    }

    Log::error('Ameria InitPayment failed', ['payload' => $payload, 'response' => $data]);

    return redirect()->route('checkout.view')
        ->with('error', 'Failed to initiate payment. Please try again later.');
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
