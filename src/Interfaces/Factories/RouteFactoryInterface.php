<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Entities\Route;
use WebSocketsZMQ\Interfaces\Collections\RouteCollectionInterface;

interface RouteFactoryInterface
{
    public function createRouteCollection(): RouteCollectionInterface;

    public function createRoute($topic, $class, $method, $validate = null): Route;
}
