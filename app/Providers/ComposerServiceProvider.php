<?php

namespace App\Providers;

use App\Http\ViewComposers\AboutVideoComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
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
        view()->composer('site.base._partials.modals', AboutVideoComposer::class);
    }
}
