<?php

namespace WebSocketsZMQ\Providers;

use Illuminate\Support\ServiceProvider;
use WebSocketsZMQ\Commands\WebSocketServer;

class WebSocketsZMQProvider extends ServiceProvider
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
        $this->publishes([__DIR__.'/../Publish/zmqPusher.php' => config_path('zmqPusher.php')], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([WebSocketServer::class]);
        }
    }
}
