<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('audio', function ($attribute, $value, $parameters, $validator) {

            $allowedExtensions = ['mp3', 'mpeg', 'mpga', 'mp3', 'wav', 'aac'];

            return in_array(strtolower($value->getClientOriginalExtension()), $allowedExtensions);
        });
    }
}
