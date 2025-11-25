<?php

namespace Tests\Feature\Ehdm;

use Tests\TestCase;
use App\Services\Ehdm\Ehdm;

class EmailTest extends TestCase
{
    public function test_can_send_fake_email()
    {
        Ehdm::fake();

        $client = Ehdm::client();

        // Create fake receipt first
        $client->print([
            'products' => [],
            'cashAmount' => 1234,
            'uniqueCode' => 'XYZ',
        ]);

        $client->sendEmail('demo@example.com');

        $response = $client->getResponse();

        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('FAKE: Email sent to demo@example.com', $response['message']);
    }
}
