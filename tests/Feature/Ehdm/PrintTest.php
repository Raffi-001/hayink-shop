<?php

namespace Tests\Feature\Ehdm;

use Tests\TestCase;
use App\Services\Ehdm\Ehdm;
use App\Services\Ehdm\EhdmClient;

class PrintTest extends TestCase
{
    public function test_can_create_fake_receipt()
    {
        Ehdm::fake();

        $payload = [
            'products' => [
                [
                    'adgCode' => '610910',
                    'goodCode' => 'TSHIRT01',
                    'goodName' => 'T-Shirt',
                    'quantity' => 1,
                    'unit' => 'pcs',
                    'price' => 1000,
                    'discount' => 0,
                    'discountType' => 2,
                    'receiptProductId' => 0,
                    'dep' => 7
                ]
            ],
            'cashAmount' => 1000,
            'cardAmount' => 0,
            'uniqueCode' => 'TEST123',
        ];

        $client = Ehdm::create($payload);

        $this->assertNotNull($client->getReceiptId());
        $this->assertArrayHasKey('res', $client->getResponse());
        $this->assertStringContainsString(
            'FAKE: Print completed successfully',
            $client->getResponse()['res']['message']
        );
    }
}
