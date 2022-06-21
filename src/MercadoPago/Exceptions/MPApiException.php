<?php

namespace MercadoPago\Exceptions;

use Exception;
use MercadoPago\Net\MPResponse;

/** MPApiException class. */
class MPApiException extends Exception
{
    private $status_code;

    private $api_response;

    /**
     * MPApiException constructor.
     */
    public function __construct(string $message, MPResponse $response)
    {
        parent::__construct($message, 0);
        $this->api_response = $response;
        $this->status_code = $response->getStatusCode();
    }

    public function getApiResponse(): MPResponse
    {
        return $this->api_response;
    }

    public function getStatusCode(): int
    {
        return $this->status_code;
    }
}
