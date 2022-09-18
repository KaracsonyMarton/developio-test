<?php

namespace App\Providers;

use App\Interfaces\PersonRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;
use App\Repositories\PersonRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
