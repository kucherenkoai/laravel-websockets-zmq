<?php

namespace WebSocketsZMQ\Collections;

use WebSocketsZMQ\Interfaces\Collections\RouteCollectionInterface;
use WebSocketsZMQ\Interfaces\Entities\RouteInterface;

class RouteCollection extends Collection implements RouteCollectionInterface {

    public function attach(RouteInterface $route): RouteInterface
    {
        $this->data[$route->getTopic()] = $route;
        return $route;
    }

    public function detach(RouteInterface $route): RouteInterface
    {
        if(!$this->data[$route->getTopic()]){
            return $route;
        }
        unset($this->data[$route->getTopic()]);
        return $this->data[$route->getTopic()];
    }

}


