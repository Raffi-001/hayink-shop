<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Ehdm\EhdmClient;

class EhdmServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EhdmClient::class, function () {
            return new EhdmClient();
        });
    }
}
