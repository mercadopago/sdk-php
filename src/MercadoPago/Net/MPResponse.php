<?php

namespace MercadoPago\Net;

/** MPResponse class. */
class MPResponse
{
    /**
     * MPResponse constructor.
     * @param int $status_code status code of the response.
     * @param mixed $content content of the response.
     */
    public function __construct(
        private int $status_code,
        private mixed $content
    ) {
    }

    /**
     * Get status code.
     * @return int status code.
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * Get content.
     * @return array content.
     */
    public function getContent(): array
    {
        return $this->content;
    }
}
