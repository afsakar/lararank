<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use NascentAfrica\Jetstrap\JetstrapFacade;
use Spatie\Activitylog\Models\Activity;

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
        Paginator::useBootstrap();
        JetstrapFacade::useAdminLte3();
//        Activity::saving(function (Activity $activity) {
//            $activity->properties = $activity->properties->put('ip', request()->ip());
//        });
    }
}
