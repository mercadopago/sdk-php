<?php

namespace MercadoPago\Net;

/**
 * Base class for all MercadoPago API resource models.
 *
 * Every resource DTO (Payment, Customer, Order, etc.) extends this class
 * to carry the raw {@see MPResponse} alongside the deserialized properties.
 * This allows callers to inspect HTTP metadata (status code, raw body) when needed.
 */
class MPResource
{
    /** @var MPResponse The raw API response that produced this resource. */
    private MPResponse $response;

    /**
     * Attaches the raw API response to this resource after deserialization.
     *
     * Called internally by client classes — not intended for end-user code.
     */
    public function setResponse(MPResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * Returns the raw API response associated with this resource.
     *
     * Useful for inspecting the HTTP status code or accessing fields
     * not yet mapped to typed properties.
     */
    public function getResponse(): MPResponse
    {
        return $this->response;
    }
}
