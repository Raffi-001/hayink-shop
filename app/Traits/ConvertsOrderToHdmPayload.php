<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Lunar\Models\Order;

trait ConvertsOrderToHdmPayload
{
    /**
     * Convert a Lunar Order model into an EHdM-compatible payload.
     */
    public function toHdmPayload(): array
    {
        /** @var Order $order */
        $order = $this;

        return [
            'products'               => $this->mapOrderLinesToHdm($order),
            'additionalDiscount'     => $this->getOrderLevelDiscount($order),
            'additionalDiscountType' => $this->getOrderLevelDiscountType($order),
            'cashAmount'             => $this->getCashAmount($order),
            'cardAmount'             => $this->getCardAmount($order),
            'partialAmount'          => 0,
            'prePaymentAmount'       => 0,
            'partnerTin'             => $this->getCustomerTin($order),
            'uniqueCode'             => $this->generateUniqueCode($order),
            'eMarks'                 => [], // if not used, keep empty array
        ];
    }

    /**
     * Convert all order lines → EHdM Product model array.
     */
    protected static function mapOrderLines(Order $order): array
    {
        $products = [];

        foreach ($order->lines as $index => $line) {

            if ($line->type !== 'product') {
                continue;
            }

            $products[] = [
                'adgCode' => static::adgCode($line),
                'goodCode' => $line->sku ?? $line->identifier,
                'goodName' => substr($line->description, 0, 50),
                'quantity' => (float) $line->quantity,
                'unit' => 'pcs',
                'price' => (float) $line->unit_price->decimal,
                'discount' => (float) $line->discount_total->decimal,
                'discountType' => $line->discount_total->decimal > 0 ? 2 : 0,
                'receiptProductId' => $index,
                'dep' => static::taxDep($line),
            ];
        }

        return $products;
    }

    /**
     * Extract order-level discount.
     */
    protected function getOrderLevelDiscount(Order $order): float
    {
        return (float) $order->discount_total?->decimal ?? 0;
    }

    /**
     * Determine type of total discount.
     * 8 = % , 16 = AMD
     */
    protected function getOrderLevelDiscountType(Order $order): int
    {
        if ($order->discount_total?->value > 0) {
            return 16; // AMD discount
        }

        return 0;
    }

    /**
     * Lunar usually stores paid amounts in Transactions.
     */
    protected function getCashAmount(Order $order): float
    {
        $cash = $order->transactions->where('type', 'capture')
            ->where('driver', 'cash')
            ->sum(fn($t) => $t->amount->decimal);

        return (float) $cash;
    }

    protected function getCardAmount(Order $order): float
    {
        $card = $order->transactions->where('type', 'capture')
            ->where('driver', '!=', 'cash')
            ->sum(fn($t) => $t->amount->decimal);

        return (float) $card;
    }

    /**
     * Extract Customer TIN if stored.
     * OPTIONAL in EHdM.
     */
    protected function getCustomerTin(Order $order): ?string
    {
        return $order->getMeta('tin') ?? '';
    }

    /**
     * Generate unique request code.
     * Must be <= 30 chars & unique for each fiscal receipt.
     */
    protected function generateUniqueCode(Order $order): string
    {
        return Str::upper(
            substr("ORD{$order->id}_" . Str::random(20), 0, 30)
        );
    }

    /**
     * Map tax department (dep):
     * 1 = VAT
     * 2 = VAT exempt
     * 3 = Turnover tax
     * 7 = Microbusiness
     */
    protected function mapOrderDep($line): int
    {
        $taxClass = $line->tax_class?->name ?? '';

        return match (true) {
            str_contains($taxClass, 'VAT')        => 1,
            str_contains($taxClass, 'Exempt')     => 2,
            str_contains($taxClass, 'Turnover')   => 3,
            default                               => 7, // microbusiness default in Armenia
        };
    }

    /**
     * Product HS code → either stored on product or fallback
     */
    protected function detectAdgCode($line): string
    {
        return $line->purchasable?->product?->getAttribute('hs_code')
            ?? '5401'; // default demo code
    }
}
