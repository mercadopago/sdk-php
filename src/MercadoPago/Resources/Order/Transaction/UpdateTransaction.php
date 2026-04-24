<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order\Transaction;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents the response from updating a transaction within a MercadoPago order.
 *
 * Returned by the update transaction endpoint, this resource contains
 * the updated payment method details after modifying an existing transaction.
 *
 * @see \MercadoPago\Client\Order\OrderTransactionClient
 */
class UpdateTransaction extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Updated payment method details for the transaction. Maps to {@see \MercadoPago\Resources\Order\PaymentMethod}. */
    public array|object|null $payment_method;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
