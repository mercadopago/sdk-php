<?php

namespace MercadoPago\Resources\Point;

/** PaymentIntentAdditionalInfo class. */
class PaymentIntentAdditionalInfo
{
    /** External reference of the payment. */
    public ?string $external_reference;

    /** Print on terminal flag. */
    public ?bool $print_on_terminal;
}
