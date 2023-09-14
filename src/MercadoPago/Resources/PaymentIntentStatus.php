<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PaymentIntentStatus class. */
class PaymentIntentStatus extends MPResource
{
    /** Status of payment intent. */
    public ?string $status;

    /** Date created. */
    public ?string $created_on;
}
