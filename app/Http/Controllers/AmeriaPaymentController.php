<?php
namespace App\Http\Controllers;

use App\PaymentTypes\AmeriaPayment;
use Illuminate\Http\Request;
use Lunar\Models\Order;

class AmeriaPaymentController extends Controller
{
    public function pay(Request $request, AmeriaPayment $ameria)
    {
        $payment = $ameria->authorize();

        if ($payment->success) {
            $order = $ameria->getOrder();

            // Redirect user to AmeriaBank secure page
            return redirect()->away($order->meta['ameria_redirect_url']);
        }

        return back()->withErrors(['payment' => $payment->message]);
    }
}
