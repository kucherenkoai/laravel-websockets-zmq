<?php

namespace WebSocketsZMQ\Interfaces\Entities;

use WebSocketsZMQ\Interfaces\Request\RequestInterface;

interface RouterInterface
{
    public function __construct();

    public function auth($topic, UserInterface $user): bool;

    public function routes(): void;

    public function make(RequestInterface $request);

    public function addRouter($topic, $class, $method, $validate = null): void;
}
