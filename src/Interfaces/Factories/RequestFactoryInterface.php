<?php

namespace WebSocketsZMQ\Interfaces\Factories;

use WebSocketsZMQ\Interfaces\Request\RequestInterface;
use WebSocketsZMQ\Interfaces\Request\RequestMessageInterface;
use WebSocketsZMQ\Interfaces\Request\RequestParamsInterface;
use WebSocketsZMQ\Interfaces\Entities\TopicInterface;
use WebSocketsZMQ\Interfaces\Entities\UserInterface;
use WebSocketsZMQ\Requests\RequestMessage;
use WebSocketsZMQ\Requests\RequestParams;

interface RequestFactoryInterface
{
    public function createRequest(): RequestInterface;

    public function createRequestParams(TopicInterface $topic, RequestMessageInterface $requestMessage): RequestParams;

    public function createRequestMessage(string $msg): RequestMessage;
}
