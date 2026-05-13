<?php

namespace MercadoPago\Exceptions;

use Exception;

/**
 * Exception thrown by {@see \MercadoPago\Webhook\WebhookSignatureValidator}
 * when a webhook notification cannot be confirmed as originating from MercadoPago.
 *
 * Carries enough context to support structured logging without exposing
 * internal details in the HTTP response body.
 */
class InvalidWebhookSignatureException extends Exception
{
    /** @var string One of the {@see SignatureFailureReason} constants. */
    private string $reason;

    /** @var string|null The `x-request-id` header value, when available. */
    private ?string $requestId;

    /** @var string|null The `ts` value extracted from the signature header, when available. */
    private ?string $timestamp;

    /**
     * @param string      $reason    One of the {@see SignatureFailureReason} constants.
     * @param string|null $requestId The `x-request-id` header value associated with the request.
     * @param string|null $timestamp The `ts` value extracted from the header, when parsing reached that point.
     */
    public function __construct(string $reason, ?string $requestId = null, ?string $timestamp = null)
    {
        parent::__construct(sprintf('Invalid webhook signature: %s', $reason));
        $this->reason = $reason;
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
    }

    /** Returns the specific failure reason ({@see SignatureFailureReason}). */
    public function getReason(): string
    {
        return $this->reason;
    }

    /** Returns the `x-request-id` header value associated with the request, or null. */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /** Returns the `ts` value extracted from the signature header, or null. */
    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }
}
