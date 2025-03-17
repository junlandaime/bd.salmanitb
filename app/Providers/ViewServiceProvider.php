<?php

namespace App\Providers;

use App\Models\About;
use App\Models\LandingPage;
use App\Models\ProgramLayanan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewInstance;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Make sure to use the correct view path

        View::composer('layouts.footer', function (ViewInstance $view) {
            $landingpage = LandingPage::firstOrFail();

            $view->with([
                'footerLandingPage' => $landingpage,

            ]);
        });

        View::composer('layouts.app', function (ViewInstance $view) {
            $landingpage = LandingPage::firstOrFail();

            $view->with([
                'frontLandingPage' => $landingpage
            ]);
        });
    }
}
