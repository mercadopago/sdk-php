<?php

namespace MercadoPago\Resources\Preference;

/** URLs class. */
class Urls
{
    /** URL to when the payment succeed. */
    public ?string $success;

    /** URL to when the payment is pending. */
    public ?string $pending;

    /** URL to when the payment fail. */
    public ?string $failure;
}
