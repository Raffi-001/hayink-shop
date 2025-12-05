<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Lunar\Models\Order;

class AmeriaPaymentService
{
    public function initPayment(Order $order): string
    {
        // Local test mode
        if (app()->environment('local')) {
            $ameriaOrderId = rand(3770005, 3771000);
            $amountAMD = 10.00;
        } else {
            $ameriaOrderId = (int)$order->id;
            $amountAMD = $order->total;
        }

        $payload = [
            'ClientID' => config('services.ameria.client_id'),
            'Username' => config('services.ameria.username'),
            'Password' => config('services.ameria.password'),
            'Amount'   => $amountAMD,
            'OrderID'  => $ameriaOrderId,
            'BackURL'  => route('ameria-hook'),
            'Description' => "Order #{$ameriaOrderId}",
            'Currency' => '051',
        ];

        \Log::debug($payload);

        $response = Http::acceptJson()->post(
            config('services.ameria.base_url') . '/InitPayment',
            $payload
        );

        $data = $response->json();

        Log::info('Ameria InitPayment Response', $data);

        if (($data['ResponseCode'] ?? 0) != 1 || empty($data['PaymentID'])) {
            throw new \Exception("Ameria InitPayment failed: " . json_encode($data));
        }

        $order->update([
            'reference' => "HAYINK-{$ameriaOrderId}",
            'meta' => array_merge((array)$order->meta, [
                'ameria_payment_id' => $data['PaymentID'],
                'ameria_initiated_at' => now(),
            ]),
        ]);

        return config('services.ameria.payment_url') . "?id={$data['PaymentID']}&lang=en";
    }

    public function getPaymentDetails(string $paymentId): array
    {
        $result = Http::acceptJson()->post(
            config('services.ameria.base_url') . '/GetPaymentDetails',
            [
                'PaymentID' => $paymentId,
                'Username'  => config('services.ameria.username'),
                'Password'  => config('services.ameria.password'),
            ]
        );

        return $result->json();
    }
}
