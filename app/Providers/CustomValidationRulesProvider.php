<?php

namespace App\Providers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidationRulesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // Validator::extend('unique_parent_category', function ($attribute, $value, $parameters, $validator) {
            
        //     $exists = \App\Categories::where('parent_category', $value)->exists();
        //     return !$exists;
        // });
    }
}
