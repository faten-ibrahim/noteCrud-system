<?php

namespace App\Providers;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\NoteRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\NoteRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
