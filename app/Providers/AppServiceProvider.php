<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ListaBlanca;
use App\Policies\ListaBlancaPolicy;

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
        //
    }
    protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ListaBlanca::class => ListaBlancaPolicy::class, // <-- AÑADE ESTA LÍNEA
];
}
