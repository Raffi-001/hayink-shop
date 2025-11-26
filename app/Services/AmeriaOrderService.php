<?php

namespace App\Services;

use Lunar\Facades\CartSession;
use Lunar\Models\Order;
use App\Services\Ehdm\Ehdm;
use App\Services\Ehdm\Transformers\OrderToHdmPayload;
use Illuminate\Support\Facades\Log;

class AmeriaOrderService
{
    public function createFromCart($cart): Order
    {
        $cart->calculate();

        $order = $cart->createOrder();

        $order->update([
            'status'    => 'awaiting-payment',
            'reference' => 'HAYINK-' . $order->id,
            'meta'      => array_merge((array)$order->meta, [
                'created_from_cart' => true,
                'cart_id' => $cart->id,
            ]),
        ]);

        CartSession::forget();

        return $order;
    }

    public function capturePayment(string $paymentId, string $orderId, array $paymentData): Order
    {
        $order = Order::where('reference', 'HAYINK-' . $orderId)->firstOrFail();

        // Avoid duplicates
        if ($order->status === 'payment-received') {
            return $order;
        }

        $order->update([
            'status' => 'payment-received',
            'meta' => array_merge((array)$order->meta, [
                'ameria_payment_id' => $paymentId,
                'ameria_payment_confirmed_at' => now(),
                'ameria_response_data' => $paymentData,
            ]),
        ]);

        $order->transactions()->create([
            'type'   => 'capture',
            'amount' => $order->total,
            'reference' => $paymentId,
            'status' => 'success',
            'success' => true,
            'driver'  => 'offline',
            'card_type' => 'unknown',
            'notes'   => 'Payment confirmed via Ameria webhook',
            'meta'    => $paymentData,
        ]);

        // Generate EHdM receipt
        try {
            $payload = OrderToHdmPayload::make($order);

            $ehdm    = Ehdm::create($payload);

            $order->update([
                'meta' => array_merge((array)$order->meta, [
                    'ehdm_receipt_id' => $ehdm->getReceiptId(),
                    'ehdm_history_id' => $ehdm->getHistoryId(),
                    'ehdm_client_response' => $ehdm->getResponse(),
                ])
            ]);
        } catch (\Throwable $e) {
            Log::error('EHdM receipt generation failed: ' . $e->getMessage());
        }

        return $order;
    }
}
