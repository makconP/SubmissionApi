<?php

namespace App\Providers;

use App\Services\Contracts\SubmissionServiceInterface;
use App\Services\SubmissionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubmissionServiceInterface::class, SubmissionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
