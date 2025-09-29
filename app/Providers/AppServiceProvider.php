<?php

namespace App\Providers;

use App\Repositories\IssueRepository;
use App\Repositories\IssueRepositoryInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Services\IssueService;
use App\Services\IssueServiceInterface;
use App\Services\ProjectService;
use App\Services\ProjectServiceInterface;
use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(
            ProjectRepositoryInterface::class,
            ProjectRepository::class
        );
        $this->app->bind(
            ProjectServiceInterface::class,
            ProjectService::class
        );
        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );
        $this->app->bind(
            TaskServiceInterface::class,
            TaskService::class
        );
        $this->app->bind(
            IssueRepositoryInterface::class,
            IssueRepository::class
        );
        $this->app->bind(
            IssueServiceInterface::class,
            IssueService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
