<?php

namespace App\Providers;

use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\PostService;
use App\Services\PostServiceInterface;
use App\Services\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
  
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      
    }
}
