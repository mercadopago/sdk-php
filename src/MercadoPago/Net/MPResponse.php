<?php

namespace MercadoPago\Net;

/** MPResponse class. */
class MPResponse
{
    /**
     * MPResponse constructor.
     * @param int $status_code status code of the response.
     * @param array $content content of the response.
     */
    public function __construct(
        private int $status_code,
        private ?array $content
    ) {
    }

    /**
     * Get the status code of the response.
     * @return int status code of the response.
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * Get the content of the response.
     * @return array content of the response.
     */
    public function getContent(): array
    {
        return $this->content;
    }
}
