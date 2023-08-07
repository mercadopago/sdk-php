<?php

namespace MercadoPago\Net;

/**
 * Default implementation of HttpRequest.
 */
class CurlRequest implements HttpRequest
{
    private $handle;

    /**
     * CurlRequest constructor.
     */
    public function __construct()
    {
        $this->handle = curl_init();
    }

    /**
     * Set request options.
     * @param array $value options to be set.
     * @return void
     */
    public function setOptionArray(array $value): void
    {
        curl_setopt_array($this->handle, $value);
    }

    /**
     * Execute the request.
     * @return bool|string response from the request.
     */
    public function execute(): bool|string
    {
        return curl_exec($this->handle);
    }

    /**
     * Get information about the request.
     * @param mixed $name name of the information to be retrieved.
     * @return mixed information retrieved.
     */
    public function getInfo(mixed $name): mixed
    {
        return curl_getinfo($this->handle, $name);
    }

    /**
     * Close the request.
     * @return void
     */
    public function close(): void
    {
        curl_close($this->handle);
    }

    /**
     * Return the error from the request.
     * @return string error from the request.
     */
    public function error(): string
    {
        return curl_error($this->handle);
    }
}
