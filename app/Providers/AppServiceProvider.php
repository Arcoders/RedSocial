<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Laravel\Dusk\DuskServiceProvider;
use App\Http\Composers\PostSidebarComposer;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }

        Carbon::setLocale(config('app.locale'));

        $this->registerViewComposer();

    }

    protected function registerViewComposer()
    {
        View::composer('posts.sidebar', PostSidebarComposer::class);
    }

}
