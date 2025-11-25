<?php

namespace App\Services\Ehdm;

class Ehdm
{
    public static function client(): EhdmClient
    {
        return app(EhdmClient::class)->login();
    }

    public static function create(array $receiptData): EhdmClient
    {
        return static::client()->print($receiptData);
    }

    public static function fake(): void
    {
        app()->bind(EhdmClient::class, EhdmFake::class);
    }

}
