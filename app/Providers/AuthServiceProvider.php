<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];
    
    protected $middlewareGroups = [
        'web' => [
            // ... other middlewares
        ],
    
        'api' => [
            'throttle:api',
            'bindings',
        ],
    ];
    

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
