<?php

namespace WebSocketsZMQ\ZMQContexts;

use WebSocketsZMQ\Interfaces\Config\ConfigInterface;
use WebSocketsZMQ\Pusher;
use \React\ZMQ\Context;

class ZMQPullContext {

    private Context $context;
    private Pusher $pusher;
    private string $functionName;
    private string $host;
    private $pull;

    public function __construct(ConfigInterface $config)
    {
        $this->host = $config->getContextPullHost();
    }

    public function create(Pusher $pusher, string $functionName, $loop)
    {
        $this->pusher = $pusher;
        $this->functionName = $functionName;

        $this->context = $this->addLoop($loop);
        $this->pull = $this->addPull();
        $this->makeBind();
        $this->makeOn();
    }

    private function addLoop($loop)
    {
        return new Context($loop);
    }

    private function addPull()
    {
        return $this->context->getSocket(7);
    }

    private function makeBind()
    {
        $this->pull->bind('tcp://'.$this->host);
    }

    private function makeOn()
    {
        $this->pull->on('message', array($this->pusher, $this->functionName));
    }


}
