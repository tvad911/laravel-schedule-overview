<?php

namespace MicheleCurletta\LaravelScheduleOverview;

use Illuminate\Support\ServiceProvider;

class ScheduleOverviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('command.schedule:overview', ScheduleOverviewCommand::class);

        $this->commands([
            'command.schedule:overview',
        ]);
    }
}
