<?php

namespace MercadoPago\Net;

/**
 * Http request interface.
 */
interface HttpRequest
{
    /**
     * Set request options.
     * @param array $value options to be set.
     * @return void
     */
    public function setOptionArray(array $value): void;

    /**
     * Execute the request.
     * @return bool|string response from the request.
     */
    public function execute(): bool|string;

    /**
     * Get information about the request.
     * @param mixed $name name of the information to be retrieved.
     * @return mixed information retrieved.
     */
    public function getInfo(mixed $name): mixed;

    /**
     * Close the request.
     * @return void
     */
    public function close(): void;

    /**
     * Return the error from the request.
     * @return string error from the request.
     */
    public function error(): string;
}
