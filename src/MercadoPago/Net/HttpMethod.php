<?php

namespace MercadoPago\Net;

/**
 * Supported HTTP methods for MercadoPago API requests.
 *
 * Used by {@see MPRequest} and {@see \MercadoPago\Client\MercadoPagoClient}
 * to specify the verb for each API call.
 */
class HttpMethod
{
    public const GET = "GET";
    public const POST = "POST";
    public const PUT = "PUT";
    public const PATCH = "PATCH";
    public const DELETE = "DELETE";
}
