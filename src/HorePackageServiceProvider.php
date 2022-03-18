<?php

namespace Hore\HorePackage;

use Illuminate\Support\ServiceProvider;

class HorePackageServiceProvider extends ServiceProvider
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
        //route
        $this->loadRoutesFrom(__DIR__."./routes/route.php");

        // migration
        $this->loadMigrationsFrom(__DIR__."./database/migrations");
    }
}
