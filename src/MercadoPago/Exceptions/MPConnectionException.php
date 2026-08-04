<?php

namespace MercadoPago\Exceptions;

use Exception;

/** Thrown when a transport-level or network error occurs (timeout, DNS failure, SSL error). */
class MPConnectionException extends Exception {}
