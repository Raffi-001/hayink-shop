<?php

namespace App\Services\Ehdm;

use Illuminate\Support\Str;

class EhdmFake extends EhdmClient
{
    protected bool $loggedIn = false;

    public function login(): static
    {
        $this->loggedIn = true;
        $this->token = 'fake-jwt-token';

        return $this;
    }

    public function print(array $payload): static
    {
        $this->ensureLoggedIn();

        $this->receiptId = rand(10000, 99999);
        $this->historyId = rand(1000000, 9999999);
        $this->uniqueCode = Str::uuid()->toString();

        $this->lastResponse = [
            "link" => "https://fake.payx.test/receipt/{$this->receiptId}.pdf",
            "reverseLink" => "https://fake.payx.test/reverse/{$this->receiptId}.pdf",
            "res" => [
                "receiptId" => $this->receiptId,
                "printResponse" => [
                    "crn" => "FAKECRN",
                    "sn" => "FAKESN",
                    "tin" => "12345678",
                    "total" => $payload['cashAmount'] ?? 100,
                ],
                "message" => "FAKE: Print completed successfully",
            ]
        ];

        return $this;
    }

    public function sendEmail(string $email, int $language = 0): static
    {
        $this->ensureLoggedIn();

        $this->lastResponse = [
            "message" => "FAKE: Email sent to $email"
        ];

        return $this;
    }

    public function sendSms(string $phone, int $language = 0): static
    {
        $this->ensureLoggedIn();

        $this->lastResponse = [
            "message" => "FAKE: SMS sent to $phone"
        ];

        return $this;
    }

    public function reverse(array $payload): static
    {
        $this->ensureLoggedIn();

        $this->lastResponse = [
            "message" => "FAKE: Reverse completed",
            "receiptId" => $this->receiptId ?? rand(10000, 99999),
        ];

        return $this;
    }

    public function historyByReceiptId(int $receiptId): array
    {
        $this->ensureLoggedIn();

        return [
            "id" => rand(100000, 999999),
            "receiptId" => $receiptId,
            "status" => 1,
            "products" => [],
            "message" => "FAKE: History data",
        ];
    }

    public function getOldPdf(int $historyId): array
    {
        $this->ensureLoggedIn();

        return [
            "url" => "https://fake.payx.test/old/{$historyId}.pdf"
        ];
    }

    protected function ensureLoggedIn()
    {
        if (!$this->loggedIn) {
            throw new \Exception("Fake EHdM: Not logged in! Call login() first.");
        }
    }
}
