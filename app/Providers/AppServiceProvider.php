<?php

namespace App\Providers;

use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\CourseRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\AdminRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\LessonRepository;
use App\Repositories\LessonRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
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
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->singleton(          
            AdminRepositoryInterface::class,
            AdminRepository::class,
        );

        $this->app->singleton(          
            CourseRepositoryInterface::class,
            CourseRepository::class,
        );

         $this->app->singleton(          
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->singleton(          
            LessonRepositoryInterface::class,
            LessonRepository::class,
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
