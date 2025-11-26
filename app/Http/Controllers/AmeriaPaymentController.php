<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lunar\Facades\CartSession;
use App\Services\AmeriaPaymentService;
use App\Services\AmeriaOrderService;
use Illuminate\Support\Facades\Log;

class AmeriaPaymentController extends Controller
{
    public function pay()
    {
        $cart = CartSession::current();

        if (!$cart || $cart->lines->isEmpty()) {
            return redirect()->route('checkout.view')
                ->with('error', 'Your cart is empty.');
        }

        // Create the order using the pipeline
        $order = app(AmeriaOrderService::class)->createFromCart($cart);

        // Request payment URL from Ameria
        $paymentUrl = app(AmeriaPaymentService::class)->initPayment($order);

        return redirect()->away($paymentUrl);
    }

    public function hook(Request $request)
    {
        Log::info('Ameria webhook received', $request->all());

        $paymentId = $request->input('paymentID');
        $orderId   = $request->input('orderID');

        if (!$paymentId) {
            Log::warning('Missing paymentID');
            return redirect()->route('checkout.view')
                ->with('error', 'Payment ID missing.');
        }

        // Validate payment with Ameria
        $details = app(AmeriaPaymentService::class)->getPaymentDetails($paymentId);

        $approved =
            ($request->input('resposneCode') === '00' ||
                $request->input('responseCode') === '00' ||
                ($details['ResponseCode'] ?? null) == '00');

        if (!$approved) {
            Log::warning("Payment not approved", $details);
            return redirect()->route('checkout.view')
                ->with('error', 'Payment failed.');
        }

        // Attach payment to order + generate EHdM
        $result = app(AmeriaOrderService::class)->capturePayment($paymentId, $orderId, $details);

        return redirect()->route('checkout-success.view')
            ->with('success', 'Your payment was successful!')
            ->with('completed_order_id', $result->id);
    }
}
