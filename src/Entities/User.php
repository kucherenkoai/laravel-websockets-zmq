<?php

namespace WebSocketsZMQ\Entities;

use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use \Ratchet\ConnectionInterface;

class User implements UserInterface {

    private $id;

    private ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection, $userId)
    {
        $this->id = $userId;
        $this->connection = $connection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getConnection()
    {
        return $this->connection;
    }

}


