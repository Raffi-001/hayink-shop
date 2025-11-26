<?php

namespace App\Services\Ehdm\Transformers;

use Illuminate\Support\Str;
use Lunar\Models\Order;

class OrderToHdmPayload
{
    public static function make(Order $order): array
    {
        $order->load(['lines']); // only load raw lines, not purchasable yet

        // Load purchasable/product ONLY for physical lines
        $productLines = $order->lines->filter(function ($line) {
            return $line->type === 'physical' &&
                $line->purchasable_type === 'product_variant';
        });

        $productLines->load('purchasable.product');

        return [
            'products'               => static::mapOrderLines($productLines),
            'additionalDiscount'     => 0,
            'additionalDiscountType' => 0,
            'cashAmount'             => static::cashAmount($order),
            'cardAmount'             => static::cardAmount($order),
            'partialAmount'          => 0,
            'prePaymentAmount'       => 0,
            'partnerTin'             => '72924257', // static::partnerTin($order),
            'uniqueCode'             => static::uniqueCode($order),
            'eMarks'                 => [],
        ];
    }

    protected static function mapOrderLines($productLines): array
    {
        $products = [];

        foreach ($productLines as $index => $line) {

            // ───── build product name ──────────────────────────────
            $goodName = substr($line->description, 0, 50);

            // ───── build ADG / HS code ─────────────────────────────
            $adg = optional($line->purchasable->product)->hs_code ?? '5401';

            $products[] = [
                'adgCode'          => $adg,
                'goodCode'         => $line->identifier,
                'goodName'         => $goodName,
                'quantity'         => (float)$line->quantity,
                'unit'             => 'pcs',
                'price'            => (float)$line->unit_price->decimal,
                'discount'         => (float)$line->discount_total->decimal,
                'discountType'     => $line->discount_total->decimal > 0 ? 2 : 0,
                'receiptProductId' => $index,
                'dep'              => 7,
            ];
        }

        return $products;
    }

    protected static function partnerTin(Order $order): string
    {
        return $order->meta['tin'] ?? '';
    }

    protected static function uniqueCode(Order $order): string
    {
        return Str::upper(substr("ORD{$order->id}_" . Str::random(20), 0, 30));
    }

    protected static function cashAmount(Order $order): float
    {
        return 0;
    }

    protected static function cardAmount(Order $order): float
    {
        return (float) $order->total->decimal;
    }
}
