<?php

namespace WebSocketsZMQ\Interfaces\Entities;

interface ExceptionInterface
{
    public function __construct(string $message);

    public function getResult(): bool;

    public function getMessage(): string;
}
