<?php

namespace WebSocketsZMQ\Entities;

use WebSocketsZMQ\Interfaces\Request\RequestInterface;
use WebSocketsZMQ\Interfaces\Entities\RouteInterface;

class Route implements RouteInterface {

    private $topic;

    private $class;

    private $method;

    private $requestValidate;

    public function __construct($topic, $class, $method, $requestValidate = null)
    {
        $this->topic = $topic;
        $this->class = $class;
        $this->method = $method;
        $this->requestValidate = $requestValidate;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getRequestValidate()
    {
        return $this->requestValidate;
    }

    public function make(RequestInterface $request)
    {
        $class = $this->getClass();
        $method = $this->getMethod();
        return (new $class)->$method($request);
    }

}


