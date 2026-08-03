<?php

namespace MercadoPago\Exceptions;

/** Thrown when the API returns HTTP 424 Failed Dependency (internal dependency failure — retryable). */
class MPDependencyException extends MPApiException {}
