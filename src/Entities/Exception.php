<?php

namespace WebSocketsZMQ\Entities;

class Exception {

    private bool $fails = false;
    private ?string $message = null;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function fails(): bool
    {
         return $this->fails;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}


