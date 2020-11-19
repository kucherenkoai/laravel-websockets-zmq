<?php

namespace WebSocketsZMQ\Commands;

use Illuminate\Console\Command;
use WebSocketsZMQ\Server;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:webSocketServer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Websocket Server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $server = new Server();
        $server->start();
    }
}
