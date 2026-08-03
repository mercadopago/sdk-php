<?php

namespace MercadoPago\Exceptions;

/** Thrown when the API returns HTTP 401 Unauthorized (missing or invalid credentials). */
class MPAuthenticationException extends MPApiException {}
