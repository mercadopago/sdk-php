<?php

namespace MercadoPago\Exceptions;

/** Thrown when the API returns HTTP 423 Locked (idempotency key temporarily locked — retryable). */
class MPResourceLockedException extends MPApiException {}
