<?php

namespace MercadoPago\Exceptions;

/** Thrown when the API returns HTTP 422 Unprocessable Entity (business rule violation). */
class MPValidationException extends MPApiException {}
