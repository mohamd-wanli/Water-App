<?php

namespace App\Providers;

use App\Repository\Eloquent\AdminRepository;
use App\Repository\Eloquent\DistributorRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Interfaces\AdminRepositoryInterface;
use App\Repository\Interfaces\DistributorRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(DistributorRepositoryInterface::class,DistributorRepository::class);
        $this->app->bind(AdminRepositoryInterface::class,AdminRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
