<?php

namespace MercadoPago\Exceptions;

use Exception;
use MercadoPago\Net\MPResponse;

/** MPApiException class. */
class MPApiException extends Exception
{
    private $statusCode;

    private $apiResponse;

    /**
     * MPApiException constructor.
     */
    public function __construct(string $message, MPResponse $response)
    {
        parent::__construct($message, 0);
        $this->apiResponse = $response;
        $this->statusCode = $response->getStatusCode();
    }

    public function getApiResponse(): MPResponse
    {
        return $this->apiResponse;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
