<?php

namespace WebSocketsZMQ\Interfaces\Entities;

interface RouteInterface
{
    public function __construct($topic, $class, $method, $requestValidate = null);

    public function getTopic();

    public function getClass();

    public function getMethod();

    public function getRequestValidate();


}
