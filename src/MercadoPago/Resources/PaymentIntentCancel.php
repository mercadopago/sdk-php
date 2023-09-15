<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PaymentIntentCancel class. */
class PaymentIntentCancel extends MPResource
{
    /** ID of the payment intent.*/
    public ?string $id;
}
