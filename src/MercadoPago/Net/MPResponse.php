<?php

namespace MercadoPago\Net;

/** MPResponse class. */
class MPResponse
{
    private $status_code;

    private $content;

    /**
     * MPResponse constructor.
     * @param int $status_code status code of the response.
     * @param mixed $content content of the response.
     */
    public function __construct(int $status_code, $content)
    {
        $this->status_code = $status_code;
        $this->content = $content;
    }

    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    public function getContent(): array
    {
        return $this->content;
    }
}
