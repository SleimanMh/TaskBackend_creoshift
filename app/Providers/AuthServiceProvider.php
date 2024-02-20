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
            \App\Http\Middleware\AdminMiddleware::class,
        ],
    
        'api' => [
            'throttle:api',
            'bindings',
            \App\Http\Middleware\AdminMiddleware::class,
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
