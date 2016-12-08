<?php

namespace Digi\Providers;

use Illuminate\Support\ServiceProvider;

class DigiCommonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__."/../smart-admin" => public_path("smart-admin"),
        ], "digi_public");
        $this->publishes([
            __DIR__."/../common-css" => public_path("digi/css"),  
        ], "digi_public");
		$this->publishes([
            __DIR__."/../fonts" => public_path("digi/fonts"),  
       ], "digi_public");

        $this->loadViewsFrom(__DIR__."/../Views", "digicommon");

        $this->publishes([
            __DIR__."/../Views/auth" => base_path('resources/views/auth'),
        ], "digi_auth_views");

        $this->publishes([
            __DIR__."/../Views/smart-admin" => base_path('resources/views/vendor/digi/smart-admin'),
        ], "digi_smart_admin_views");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__."/../Config/routes.php";
        $this->app->make("Digi\Controllers\Auth\AuthController");
        $this->app->make("Digi\Controllers\Auth\PasswordController");
    }
}
