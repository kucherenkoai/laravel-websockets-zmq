<?php

namespace WebSocketsZMQ;

use WebSocketsZMQ\Factories\ClientFactory;
use WebSocketsZMQ\Factories\ConfigFactory;
use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Logs\PusherLogs;
use WebSocketsZMQ\ZMQContexts\ZMQPushContext;

class Response {

    private array $users       = [];
    private $topicName         = null;
    private $data              = null;
    private ZMQPushContext $zmqPushContext;
    private BroadcastInterface $broadcast;
    private PusherLogs $logs;


    public function __construct()
    {
        $configFactory = new ConfigFactory();
        $clientFactory = new ClientFactory();
        $this->logs    = new PusherLogs();


        $this->zmqPushContext = $configFactory->createZMQPushContext($configFactory->createConfig());
        $this->broadcast = $clientFactory->createBroadcast();
    }

    private function reset(): void
    {
        $this->topicName = null;
        $this->data = null;
        $this->users = [];
    }

    public function getTopicName()
    {
        return $this->topicName;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function getData()
    {
        return $this->data;
    }

    public function addTopicName(string $topicName)
    {
        $this->topicName = $topicName;
        return $this;
    }

    public function addUsers(array $users)
    {
        $this->users = $users;
        return $this;
    }

    public function addData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function send()
    {
        if(!$this->getTopicName()){
            $this->logs->notifications("Topic name not found",false);
            return false;
        }

        if(!in_array($this->topicName,$this->broadcast->topics())){
            $this->logs->notifications("Topic name as {$this->topicName} not found in broadcast",false);
            return false;
        }

        $this->zmqPushContext->getConnection()->send(json_encode(['topicName' => $this->getTopicName(),'users' => $this->getUsers(),'data' => $this->getData()]));
        $this->reset();
        return true;
    }

}
