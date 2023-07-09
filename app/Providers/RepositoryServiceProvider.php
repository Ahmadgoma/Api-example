<?php

namespace App\Providers;

use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
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
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    public function provides()
    {
        return [PostRepositoryInterface::class];
    }
}
