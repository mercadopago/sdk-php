<?php

namespace MercadoPago\Exceptions;

use Exception;
use MercadoPago\Net\MPResponse;

/**
 * Thrown when the MercadoPago API returns a non-2xx HTTP status code.
 *
 * Carries the full {@see MPResponse} so callers can inspect the status code
 * and error details returned by the API (e.g., validation messages, error codes).
 *
 * Typical usage:
 * ```php
 * try {
 *     $payment = $client->create($request);
 * } catch (MPApiException $e) {
 *     $statusCode = $e->getStatusCode();
 *     $body = $e->getApiResponse()->getContent();
 * }
 * ```
 */
class MPApiException extends Exception
{
    private int $status_code;

    private MPResponse $api_response;

    /**
     * @param string     $message  Human-readable error summary.
     * @param MPResponse $response The raw API response containing status code and error body.
     */
    public function __construct(string $message, MPResponse $response)
    {
        parent::__construct($message, 0);
        $this->api_response = $response;
        $this->status_code = $response->getStatusCode();
    }

    /** Returns the full API response including the decoded error body. */
    public function getApiResponse(): MPResponse
    {
        return $this->api_response;
    }

    /** Returns the HTTP status code from the API response (e.g., 400, 404, 500). */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }
}
