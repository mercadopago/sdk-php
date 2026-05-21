<?php

namespace MercadoPago\Net;

/**
 * cURL-based implementation of {@see HttpRequest}.
 *
 * Each instance manages a single cURL handle. The typical lifecycle is:
 * {@see setOptionArray()} → {@see execute()} → {@see getInfo()} → {@see close()}.
 *
 * Instances are not reusable after {@see close()} is called.
 */
class CurlRequest implements HttpRequest
{
    /** @var \CurlHandle cURL session handle. */
    private $handle;

    public function __construct()
    {
        $this->handle = curl_init();
    }

    /** @inheritDoc */
    public function setOptionArray(array $value): void
    {
        curl_setopt_array($this->handle, $value);
    }

    /** @inheritDoc */
    public function execute(): bool|string
    {
        return curl_exec($this->handle);
    }

    /** @inheritDoc */
    public function getInfo(mixed $name): mixed
    {
        return curl_getinfo($this->handle, $name);
    }

    /** @inheritDoc */
    public function close(): void
    {
        curl_close($this->handle);
    }

    /** @inheritDoc */
    public function error(): string
    {
        return curl_error($this->handle);
    }
}
