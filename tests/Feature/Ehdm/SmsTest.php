<?php

namespace Tests\Feature\Ehdm;

use Tests\TestCase;
use App\Services\Ehdm\Ehdm;

class SmsTest extends TestCase
{
    public function test_can_send_fake_sms()
    {
        Ehdm::fake();

        $client = Ehdm::client();

        // Print fake receipt
        $client->print([
            'products' => [],
            'cashAmount' => 500,
            'uniqueCode' => 'SMS123',
        ]);

        $client->sendSms('+37477000000');

        $response = $client->getResponse();

        $this->assertArrayHasKey('message', $response);
        $this->assertEquals(
            'FAKE: SMS sent to +37477000000',
            $response['message']
        );
    }
}
