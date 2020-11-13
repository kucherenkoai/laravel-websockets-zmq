<?php

namespace WebSocketsZMQ\Entities;

use WebSocketsZMQ\Interfaces\Entities\BroadcastInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use Ratchet\ConnectionInterface;
use WebSocketsZMQ\Logs\PusherLogs;

abstract class Broadcast implements BroadcastInterface {

    private PusherLogs $logs;

    public function __construct()
    {
        $this->logs = new PusherLogs();
    }

    abstract protected function connect(array $connectionParams);

    abstract protected function subscribe($topic, UserInterface $user): bool;

    abstract public function topics(): array;

    public function broadcastConnect(ConnectionInterface $conn)
    {
        parse_str($conn->httpRequest->getUri()->getQuery(),$requestParams);

        $userId = $this->connect($requestParams);

        if($userId === null){
            $this->logs->connect('Broadcast validation for new connect fail',$conn,false);
            return false;
        }

        if(!is_int($userId) || !is_string($userId)){
            new \Exception('Client validator must be return user id or null');
        }
        $this->logs->connect('Broadcast validation for new connect success',$conn,true);

        return $userId;
    }

    public function broadcastSubscribe(TopicInterface $topic, UserInterface $user): bool
    {
        if(!$result = $this->subscribe($topic->getName(),$user)){
            $this->logs->topicUser('User connect to topic, broadcast validation fail.',$user,$topic,false);
            return false;
        }
        $this->logs->topicUser('User connect to topic, broadcast validation success.',$user,$topic,true);
        return $result;
    }
}


