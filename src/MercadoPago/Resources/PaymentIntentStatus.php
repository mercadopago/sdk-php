<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * Payment Intent Status resource (Point integration).
 *
 * Represents the current processing status of a payment intent on a Point device,
 * including when the status was recorded.
 *
 * @see \MercadoPago\Client\Point\PointClient
 */
class PaymentIntentStatus extends MPResource
{
    /** Status of payment intent. */
    public ?string $status;

    /** Date created. */
    public ?string $created_on;
}
