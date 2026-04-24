<?php

namespace MercadoPago\Exceptions;

use Exception;

/**
 * Thrown when an invalid argument is passed to SDK configuration methods.
 *
 * For example, setting an unsupported runtime environment value
 * via {@see \MercadoPago\MercadoPagoConfig::setRuntimeEnviroment()}.
 */
class InvalidArgumentException extends Exception
{
}
