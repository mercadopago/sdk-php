<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference URLs base resource.
 *
 * Base class for checkout redirect URLs. Defines the three outcome-based URLs
 * (success, pending, failure) that the buyer is redirected to after checkout.
 * Extended by {@see BackUrls} and {@see RedirectUrls}.
 */
class Urls
{
    /** URL to when the payment succeed. */
    public ?string $success;

    /** URL to when the payment is pending. */
    public ?string $pending;

    /** URL to when the payment fail. */
    public ?string $failure;
}
