<?php

namespace MercadoPago\Client\Customer;

/**
 * Request payload for creating a customer with minimal data (email only).
 *
 * Used internally by {@see CustomerClient::createByEmail()}.
 */
class CustomerCreateRequest
{
    /** Customer's email address. Must be unique across the merchant's customer base. */
    public string $email;
}
