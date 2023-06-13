<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\Log;
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
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
      /*  DB::listen(function ($query) {
            $location = collect(debug_backtrace())->filter(function ($trace) {
                if(isset($trace['file'])) {
                    return !str_contains($trace['file'], 'vendor/');
                }

            })->first(); // grab the first element of non vendor/ calls

            $bindings = implode(", ", $query->bindings); // format the bindings as string

            Log::info("
                   ------------
                   Sql: $query->sql
                   Bindings: $bindings
                   Time: $query->time
                   File: ${location['file']}
                   Line: ${location['line']}
                   ------------
            ");
        });*/
    }
}
