<?php

namespace MercadoPago\Resources\Preference;

/** BackUrls class. */
class BackUrls
{
    /** URL to return when the payment succeed. */
    public ?string $success;

    /** URL to return when the payment is pending. */
    public ?string $pending;

    /** URL to return when the payment fail. */
    public ?string $failure;
}
