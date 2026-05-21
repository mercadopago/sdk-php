<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * Payment Intent Cancel resource (Point integration).
 *
 * Represents the result of cancelling a payment intent on a Point device.
 * Contains the ID of the cancelled payment intent.
 *
 * @see \MercadoPago\Client\Point\PointClient
 */
class PaymentIntentCancel extends MPResource
{
    /** ID of the payment intent.*/
    public ?string $id;
}
