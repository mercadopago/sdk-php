<?php

namespace MercadoPago\Exceptions;

/**
 * Thrown when the API returns HTTP 409 Conflict.
 * Covers both idempotency-key conflicts and state-machine conflicts (e.g. cannot_refund_order).
 */
class MPIdempotencyException extends MPApiException {}
