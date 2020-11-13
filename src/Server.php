<?php

namespace WebSocketsZMQ;

use WebSocketsZMQ\Factories\ConfigFactory;
use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use WebSocketsZMQ\ZMQContexts\ZMQPullContext;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use \React\Socket\Server as WebSock;

class Server {

    private ZMQPullContext $zmqPullContext;
    private ConfigInterface $config;

    public function __construct()
    {
        $this->config = $this->createConfig();
        $this->zmqPullContext = $this->createZMQPullContext($this->config);
    }

    public function start()
    {
        $this->getServer();
    }

    private function getServer(): IoServer
    {
        $loop       = $this->createLoop();
        $pusher     = $this->createPusher();
        $this->zmqPullContext->create($pusher,'onBlogEntry',$loop);
        $webSock    = $this->createServer($this->config->getServerHost(),$loop);
        $wsServer   = $this->createWsServer($pusher);
        $httpServer = $this->createHttpServer($wsServer);
        $this->createIoServer($httpServer,$webSock);
        $loop->run();

    }

    private function createLoop()
    {
        return Factory::create();
    }

    private function createWsServer(Pusher $pusher): WsServer
    {
        return new WsServer($pusher);
    }

    private function createHttpServer(WsServer $wsServer): HttpServer
    {
        return new HttpServer($wsServer);
    }

    private function createIoServer(HttpServer $httpServer, WebSock $webSock): IoServer
    {
        return new IoServer($httpServer, $webSock);
    }

    private function createPusher(): Pusher
    {
        return new Pusher();
    }

    private function createServer($host,$loop): WebSock
    {
        return new WebSock($host,$loop);
    }

    private function createConfig(): ConfigInterface
    {
        return (new ConfigFactory())->createConfig();
    }

    private function createZMQPullContext(ConfigInterface $config): ZMQPullContext
    {
        return (new ConfigFactory())->createZMQPullContext($this->createConfig());
    }

}


