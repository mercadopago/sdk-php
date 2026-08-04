<?php

namespace MercadoPago\Exceptions;

/** Thrown when the API returns HTTP 400 Bad Request (validation or syntax error). */
class MPBadRequestException extends MPApiException {}
