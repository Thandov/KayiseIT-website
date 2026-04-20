<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('layouts.app', function ($view) {
            $showWhatsappFloating = true;
            $showChatbotFloating = true;

            if (Schema::hasTable('site_settings')) {
                try {
                    $settings = SiteSetting::current();
                    $showWhatsappFloating = $settings->show_whatsapp_floating;
                    $showChatbotFloating = $settings->show_chatbot_floating;
                } catch (\Throwable $e) {
                    // Keep defaults if the table exists but is unreadable.
                }
            }

            $view->with([
                'showWhatsappFloating' => $showWhatsappFloating,
                'showChatbotFloating' => $showChatbotFloating,
            ]);
        });
    }
}