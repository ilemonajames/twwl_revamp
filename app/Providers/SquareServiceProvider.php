<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Square\SquareClient;

class SquareServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SquareClient::class, function () {
            return new SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment', 'sandbox'),
                'timeout' => 20,
                'numberOfRetries' => 0,
            ]);
        });
    }
}
