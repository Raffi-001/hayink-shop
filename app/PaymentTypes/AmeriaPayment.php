<?php

namespace App\PaymentTypes;

use Illuminate\Support\Facades\Http;
use Lunar\Base\DataTransferObjects\PaymentAuthorize;
use Lunar\Base\DataTransferObjects\PaymentRefund;
use Lunar\Base\DataTransferObjects\PaymentCapture;
use Lunar\Events\PaymentAttemptEvent;
use Lunar\Models\Transaction;

class AmeriaPayment extends AbstractPayment
{
    public function authorize(): ?PaymentAuthorize
    {
        if (!$this->order) {
            if (!$this->order = $this->cart->order) {
                $this->order = $this->cart->createOrder();
            }
        }

        // Send payment initialization request to AmeriaBank
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://" . config('ameria.subdomain') . ".ameriabank.am/VPOS/api/VPOS/InitPayment", [
            'ClientID'   => config('ameria.client_id'),
            'Username'   => config('ameria.username'),
            'Password'   => config('ameria.password'),
            'OrderID'    => $this->order->id, // Ameria requires allowed test range for sandbox
            'Amount'     => $this->order->total->value,
            'Currency'   => 'AMD',
            'Description'=> "Order #{$this->order->id}",
            'BackURL'    => route('ameria.callback', ['order' => $this->order->id]),
        ]);

        $success = $response->successful();
        $data = $response->json();

        $result = new PaymentAuthorize(
            success: $success,
            message: $success ? 'Redirect customer to AmeriaBank' : 'Ameria authorization failed',
            orderId: $this->order->id,
            paymentType: 'ameriabank'
        );

        // Save redirect/paymentID in metadata if available
        if ($success && isset($data['PaymentID'])) {
            $this->order->meta = array_merge($this->order->meta ?? [], [
                'ameria_payment_id' => $data['PaymentID'],
                'ameria_redirect_url' => $data['FormUrl'] ?? null,
            ]);
            $this->order->save();
        }

        PaymentAttemptEvent::dispatch($result);

        return $result;
    }

    public function capture(Transaction $transaction, $amount = 0): PaymentCapture
    {
        // For Ameria, capture usually means confirming payment in 2-step flow.
        // If you only use 1-step payments, just mark it successful.

        return new PaymentCapture(success: true, message: 'Payment captured.');
    }

    public function refund(Transaction $transaction, int $amount = 0, $notes = null): PaymentRefund
    {
        // Call Ameria Refund API here if needed
        return new PaymentRefund(success: true, message: 'Refund successful.');
    }
}
