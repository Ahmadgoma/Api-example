<?php

namespace App\Providers;

use App\Services\PostService;
use App\Services\PostServiceInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider implements DeferrableProvider
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
        $this->app->bind(PostServiceInterface::class, PostService::class);
    }

    public function provides()
    {
        return [PostServiceInterface::class];
    }
}
