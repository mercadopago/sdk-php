<?php

namespace MercadoPago\Net;

/**
 * Low-level HTTP transport abstraction.
 *
 * Wraps the underlying HTTP library (typically cURL) so that
 * {@see MPDefaultHttpClient} can execute requests without coupling
 * to a specific transport implementation. Useful for testing with
 * mock HTTP responses.
 *
 * @see CurlRequest Default cURL-based implementation.
 */
interface HttpRequest
{
    /**
     * Configures the request with the given options array.
     *
     * @param array<int,mixed> $value cURL option constants mapped to their values (e.g., CURLOPT_URL => '...').
     */
    public function setOptionArray(array $value): void;

    /**
     * Executes the configured HTTP request.
     *
     * @return string|false Raw response body on success, or false on failure.
     */
    public function execute(): bool|string;

    /**
     * Retrieves metadata about the last executed request.
     *
     * @param int $name A CURLINFO_* constant (e.g., CURLINFO_HTTP_CODE).
     * @return mixed The requested information value.
     */
    public function getInfo(mixed $name): mixed;

    /**
     * Releases the underlying connection resources.
     */
    public function close(): void;

    /**
     * Returns the human-readable error message from the last failed request.
     *
     * @return string Error description, or empty string if no error occurred.
     */
    public function error(): string;
}
