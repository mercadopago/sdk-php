<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents barcode data for offline payment methods (e.g. boleto) in the MercadoPago API.
 *
 * Nested within {@see TransactionDetails} to provide the scannable barcode
 * content for ticket-based payment methods.
 */
class Barcode
{
    /** Raw barcode content string that can be rendered as a scannable barcode. */
    public ?string $content;
}
