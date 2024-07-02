<?php

namespace App\Providers;

use App\View\Components\Footer;
use App\View\Components\FrontLayout;
use App\View\Components\FrontMenu;
use App\View\Components\MemberLayout;
use App\View\Components\SignUpDisc;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('front-layout', FrontLayout::class);
        Blade::component('front-menu', FrontMenu::class);
        Blade::component('member-layout', MemberLayout::class);
        Blade::component('sign-up-disc', SignUpDisc::class);
        Blade::component('footer', Footer::class);
        Carbon::setToStringFormat('d-m-Y');
    }
}
