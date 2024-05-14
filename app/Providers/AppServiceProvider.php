<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

use Auth;
use Carbon\Carbon;

use App\Helpers\AuthHelpers;
use App\Helpers\EnvHelpers;
use App\Helpers\GlobalChecker;

use App\Models\Pdflinks\Pdflink;
use App\Models\EventTypes\EventType;
use App\Models\Events\Event;
use App\Models\Trails\Trail;
use App\Models\Experiences\Experience;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        if (config('web.force_https')) {
            URL::forceScheme('https');
        }


        View::composer('web.partials.header', function($view) {
            $experiences = Experience::all();
            $view->with('experiences', $experiences);
            
            $trails = Trail::all();
            $view->with('trails', $trails);

            $eventtypes = EventType::all();
            $view->with('eventtypes', $eventtypes);

            $events = Event::all();
            $view->with('events', $events);

        });

        View::composer('web.partials.footer', function($view) {
            $trails = Trail::all();
            $view->with('trails', $trails);

            $events = Event::all();
            $view->with('events', $events);

            $pdflinks = Pdflink::all();
            $view->with('pdflinks', $pdflinks);
        });


        View::composer('web.pages.events.event', function($view) {
            $trails = Trail::all();
            $view->with('trails', $trails);
        });

        View::composer('*', function ($view) {

            View::share('self', new AuthHelpers);
            
            View::share('checker', new GlobalChecker);
            View::share('env', new EnvHelpers);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
