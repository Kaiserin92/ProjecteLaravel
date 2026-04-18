<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Gate: Comprova si un usuari és admin (per rol o perquè és l'ID 1)
        Gate::define('is_admin', function (User $user) {
            return $user->role === 'admin' || $user->id === 1;
        });

        // Gate: Comprova si l'usuari és el propietari d'un recurs (per exemple, un joc de la seva col·lecció)
        Gate::define('is_owner', function (User $user, $owner_id) {
            return $user->id === $owner_id;
        });
    }
}