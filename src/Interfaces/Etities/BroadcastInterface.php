<?php

namespace WebSocketsZMQ\Interfaces\Entities;

use Ratchet\ConnectionInterface;

interface BroadcastInterface
{
    public function topics(): array;

    public function broadcastConnect(ConnectionInterface $conn);

    public function broadcastSubscribe(TopicInterface $topic, UserInterface $user): bool;


}
