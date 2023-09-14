<?php

namespace MichelMelo\Sibs;

use Illuminate\Support\ServiceProvider;
use MichelMelo\Sibs\Services\SibsService;

/**
 * Class SibsServiceProvider.
 */
class SibsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/sibs.php' => config_path('sibs.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfig();

        $this->app->bind('sibs', function () {
            return new SibsService();
        });
    }

    /**
     * Merges sibs's configs.
     *
     * @return void
     */
    private function mergeConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sibs.php',
            'sibs'
        );
    }
}
