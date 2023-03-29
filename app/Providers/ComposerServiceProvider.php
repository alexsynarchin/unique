<?php

namespace App\Providers;

use App\Http\ViewComposers\AboutVideoComposer;
use App\Models\Page;
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
        view()->composer('site.base._partials.head',function($view) {
            $page = Page::where('slug', 'home')->firstOrFail();
            $mp_seo = $page->seo;
            $view->with([
                'mp_seo' => $mp_seo
            ]);
        });
    }
}
