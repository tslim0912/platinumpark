<?php

namespace App\Providers;
use App\Mixins\FileMixins;
use App\Mixins\ArrayMixins;
use App\Mixins\RouteMixins;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Mixins\RequestMixins;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

    private function registerMixins()
    {
        /**
         * Route
         */
        Route::mixin(new RouteMixins());

        /**
         * Array
         */
        Arr::mixin(new ArrayMixins());

        /**
         * File
         */
        File::mixin(new FileMixins());

        /**
         * Request
         */
        Request::mixin(new RequestMixins());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMixins();

        Schema::defaultStringLength(191);
    }
}
