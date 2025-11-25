<?php

namespace App\Services\Ehdm;

use Illuminate\Support\Facades\Http;

class EhdmClient
{
    protected ?string $token = null;
    protected ?array $lastResponse = null;
    protected ?int $historyId = null;
    protected ?int $receiptId = null;
    protected ?string $uniqueCode = null;

    public function login(): static
    {
        \Log::debug($this->url('login'));
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(
            $this->url('login'),
            [
                'username' => config('ehdm.username'),
                'password' => config('ehdm.password'),
            ]
        );

        if (!$response->successful()) {
            throw new \Exception("EHdM login failed: " . $response->body());
        }

        $this->token = 'Bearer ' . $response->header('token');
        \Log::debug($this->token);

        return $this;
    }

    protected function req(string $endpointKey, array $data = [], string $method = 'POST')
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
            'Accept'        => 'application/json',
        ])->$method($this->url($endpointKey), $data);

        $this->lastResponse = $response->json();

        if ($response->successful()) {
            // Store frequently returned fields automatically
            $this->historyId = $response->json('res.receiptId')  // they duplicate naming
                ?? $response->json('receiptId')
                ?? $this->historyId;

            $this->receiptId = $response->json('receiptId')
                ?? $this->receiptId;

            $this->uniqueCode = $response->json('res.printResponseInfo.hdmUq')
                ?? $this->uniqueCode;
        }

        return $response;
    }

    protected function url(string $key): string
    {
        \Log::debug(rtrim(config('ehdm.base_url'), '/') . '/' . config("ehdm.endpoints.$key"));
        return rtrim(config('ehdm.base_url'), '/') . '/' . config("ehdm.endpoints.$key");
    }

    // ------------------------------------------------------------------------
    // MAIN API METHODS
    // ------------------------------------------------------------------------

    /** Print → register sale */
    public function print(array $payload): static
    {
        $response = $this->req('print', $payload);

        if (!$response->successful()) {
            throw new \Exception("EHdM Print failed: " . $response->body());
        }

        return $this;
    }

    /** Reverse by history + product list */
    public function reverse(array $payload): static
    {
        $response = $this->req('reverse', $payload);

        if (!$response->successful()) {
            throw new \Exception("EHdM Reverse failed: " . $response->body());
        }

        return $this;
    }

    /** Reverse by receipt ID */
    public function reverseByReceiptId(int $receiptId): static
    {
        $response = $this->req('reverse_by_receipt', ['receiptId' => $receiptId]);

        if (!$response->successful()) {
            throw new \Exception("EHdM ReverseByReceiptId failed");
        }

        return $this;
    }

    /** Get Old PDF */
    public function getOldPdf(int $historyId): array
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->get($this->url('get_old_pdf') . "?HistoryId=$historyId");

        if (!$response->successful()) {
            throw new \Exception("GetOldPdf failed");
        }

        return $response->json();
    }

    /** History by receipt */
    public function historyByReceiptId(int $receiptId): array
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->get($this->url('history_by_receipt') . "?receiptId=$receiptId");

        if (!$response->successful()) {
            throw new \Exception("HistoryByReceiptId failed");
        }

        return $response->json();
    }

    /** Copy by unique code */
    public function copyByUniqueCode(string $uniqueCode): array
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->get($this->url('copy_by_unique') . "?uniqueCode=$uniqueCode");

        if (!$response->successful()) {
            throw new \Exception("PrintCopyByUniqueCode failed");
        }

        return $response->json();
    }

    /** Send SMS */
    public function sendSms(string $phone, int $language = 0): static
    {
        $payload = [
            'historyId' => $this->historyId ?? 0,
            'receiptId' => $this->receiptId ?? 0,
            'phone'     => $phone,
            'language'  => $language,
        ];

        $response = $this->req('send_sms', $payload);

        if (!$response->successful()) {
            throw new \Exception("SendSms failed");
        }

        return $this;
    }

    /** Send Email */
    public function sendEmail(string $email, int $language = 0): static
    {
        $payload = [
            'historyId' => $this->historyId ?? 0,
            'receiptId' => $this->receiptId ?? 0,
            'email'     => $email,
            'language'  => $language,
        ];

        $response = $this->req('send_email', $payload);

        if (!$response->successful()) {
            throw new \Exception("SendEmail failed");
        }

        return $this;
    }

    public function getResponse(): ?array
    {
        return $this->lastResponse;
    }

    public function getHistoryId(): ?int
    {
        return $this->historyId;
    }

    public function getReceiptId(): ?int
    {
        return $this->receiptId;
    }
}
