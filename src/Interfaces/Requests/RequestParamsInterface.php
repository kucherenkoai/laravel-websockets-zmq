<?php

namespace WebSocketsZMQ\Interfaces\Request;

use WebSocketsZMQ\Interfaces\Entities\TopicInterface;

interface RequestParamsInterface
{
    public function __construct(TopicInterface $topic, RequestMessageInterface $requestMessage);

    public function getCode(): int;

    public function getTopic(): TopicInterface;

    public function getBody();

    public function getRequestMessage(): RequestMessageInterface;

}
