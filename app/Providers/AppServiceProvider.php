<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interface\BaseRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Services\Interface\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
