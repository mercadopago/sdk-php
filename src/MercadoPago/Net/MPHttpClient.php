<?php

namespace MercadoPago\Net;

/**
 * Contract for HTTP clients used by the SDK to communicate with the MercadoPago API.
 *
 * Implementations handle the actual HTTP transport (e.g., cURL) and are responsible
 * for retry logic, error detection, and response parsing.
 *
 * @see MPDefaultHttpClient Default cURL-based implementation.
 */
interface MPHttpClient
{
    /**
     * Sends an HTTP request to the MercadoPago API and returns the parsed response.
     *
     * @param MPRequest $request Fully-built request including URI, method, headers, and payload.
     * @return MPResponse Parsed API response with status code and decoded JSON body.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception When a transport-level error occurs (e.g., network timeout).
     */
    public function send(MPRequest $request): MPResponse;
}
