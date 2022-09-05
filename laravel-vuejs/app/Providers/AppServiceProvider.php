<?php

namespace App\Providers;

use App\Contracts\IBaseRepository;
use App\Contracts\IPostRepository;
use App\Contracts\IUserRepository;
use App\Repository\BaseRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
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
        $this->app->bind(
            IBaseRepository::class,
            BaseRepository::class
        );
        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );
        $this->app->bind(
            IPostRepository::class,
            PostRepository::class
        );
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
