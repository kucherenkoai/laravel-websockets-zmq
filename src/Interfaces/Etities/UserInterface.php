<?php

namespace WebSocketsZMQ\Interfaces\Entities;

use Ratchet\ConnectionInterface;

interface UserInterface
{
    public function __construct(ConnectionInterface $connection,$userId);

    public function getId();

    public function getConnection();

}
