<?php

namespace MercadoPago\Net;

/** MPResponse class. */
class MPResponse
{
    private $statusCode;

    private $content;

    public function __construct(int $statusCode, $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent()
    {
        return $this->content;
    }
}
