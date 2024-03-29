<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;


class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function ($app) {
            return new Setting();
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\App::runningInConsole() && count(Schema::getColumnListing('settings'))) {

            $settings = Setting::all();
            foreach ($settings as $key => $setting)
            {
                Config::set('settings.'. $setting->group . '.' .  $setting->name, $setting->value);
            }
        }
    }
}
