<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;

use App\Models\User;

use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env(key: 'APP_ENV') !== 'local') {
            URL::forceScheme(scheme: 'https');
        }

        Gate::define('admin', function (User $user) {
            return Str::lower($user->role) === 'admin';
        });
        Gate::define('dosen', function (User $user) {
            return Str::lower($user->role) === 'dosen';
        });
        Gate::define('mahasiswa', function (User $user) {
            return Str::lower($user->role) === 'mahasiswa';
        });
        Gate::define('datalengkap', function (User $user) {
            return Str::lower($user->role) === 'mahasiswa' && ($user->kelas !== null || $user->kelas !== '');
        });
    }
}
