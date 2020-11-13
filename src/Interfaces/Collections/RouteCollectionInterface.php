<?php

namespace WebSocketsZMQ\Interfaces\Collections;

use WebSocketsZMQ\Interfaces\Entities\RouteInterface;

interface RouteCollectionInterface extends CollectionInterface
{
    public function attach(RouteInterface $route): RouteInterface;

    public function detach(RouteInterface $route): RouteInterface;
}
