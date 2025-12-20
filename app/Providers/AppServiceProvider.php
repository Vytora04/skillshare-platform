<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\OrgVerification;
use App\Policies\OrgVerificationPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(OrgVerification::class, OrgVerificationPolicy::class);
        \Illuminate\Pagination\Paginator::useTailwind();
    }
}
