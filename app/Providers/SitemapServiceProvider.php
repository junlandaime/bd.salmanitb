<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravelium\Sitemap\Sitemap;

class SitemapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sitemap', function ($app) {
            $config = config('sitemap');
            return new Sitemap($config);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
