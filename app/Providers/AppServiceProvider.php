<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            try {
                $view->with('setting', \App\Models\Setting::firstOrCreate([]));
            } catch (\Exception $e) {
                $view->with('setting', null);
            }
        });

        view()->composer('layouts.admin', function ($view) {
            $view->with('unreadMessagesCount', ContactMessage::where('is_read', false)->count());
        });
    }
}
