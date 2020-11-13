<?php

namespace WebSocketsZMQ\Factories;

use WebSocketsZMQ\Collections\RouteCollection;
use WebSocketsZMQ\Entities\Route;
use WebSocketsZMQ\Interfaces\Collections\RouteCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\RouterInterface;
use WebSocketsZMQ\Interfaces\Factories\RouteFactoryInterface;
use WebSocketsZMQ\Route\Router;

class RouteFactory implements RouteFactoryInterface
{
    public function createRouteCollection(): RouteCollectionInterface
    {
        return new RouteCollection();
    }

    public function createRoute($topic, $class, $method, $validate = null): Route
    {
        return new Route($topic, $class, $method, $validate = null);
    }
}
