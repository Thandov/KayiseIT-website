<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ErrorSuppressionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Suppress deprecation warnings for PHP 8.4+ compatibility
        set_error_handler(function ($severity, $message, $file, $line) {
            // Suppress all deprecation warnings in production or when specifically requested
            if ($severity === E_DEPRECATED) {
                return true; // Suppress the warning
            }
            
            // Let other errors be handled normally
            return false;
        }, E_DEPRECATED);
    }
}
