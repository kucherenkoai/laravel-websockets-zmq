<?php

namespace WebSocketsZMQ\Interfaces\Request;

interface RequestMessageInterface
{
    public function __construct(string $msg);

    public function getCode(): int;

    public function getTopicName();

    public function getBody();

    public function validateAttachTopic(): bool;

    public function validateDetachTopic(): bool;

    public function validateForRoute(): bool;

}
