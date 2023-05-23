<?php

namespace App\Sample\Base\Providers;

use App\Sample\Base\Repositories\TestRepository;
use Illuminate\Support\ServiceProvider;

class BaseRepositoryProvider extends ServiceProvider
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
        $this->app->singleton(TestRepository::class, function () {
            return new TestRepository;
        });

        $this->app->alias(TestRepository::class, 'baserepository');
    }
}
