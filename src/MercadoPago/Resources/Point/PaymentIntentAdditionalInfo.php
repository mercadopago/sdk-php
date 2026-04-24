<?php

namespace MercadoPago\Resources\Point;

/**
 * Point Payment Intent Additional Info resource.
 *
 * Contains supplementary metadata for a Point payment intent, such as an external
 * reference for reconciliation and whether to print a receipt on the terminal.
 */
class PaymentIntentAdditionalInfo
{
    /** External reference of the payment. */
    public ?string $external_reference;

    /** Print on terminal flag. */
    public ?bool $print_on_terminal;
}
