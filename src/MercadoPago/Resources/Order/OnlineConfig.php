<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the online checkout configuration for a MercadoPago order.
 *
 * Controls the buyer's redirect flow after completing checkout, including
 * success/failure/pending URLs, and additional checkout behavior such as
 * differential pricing and 3DS security.
 *
 * @see \MercadoPago\Resources\Order\Config
 */
class OnlineConfig
{
    /** Class mapper. */
    use Mapper;

    /** URL where MercadoPago sends asynchronous payment notifications (IPN/webhook). */
    public ?string $callback_url;

    /** URL to redirect the buyer after a successful payment. */
    public ?string $success_url;

    /** URL to redirect the buyer when the payment is pending approval. */
    public ?string $pending_url;

    /** URL to redirect the buyer after a failed payment. */
    public ?string $failure_url;

    /** URL for automatic redirection after the buyer completes checkout. */
    public ?string $auto_return_url;

    /** Differential pricing configuration for offering different prices per payment method. Maps to DifferentialPricing. */
    public array|object|null $differential_pricing;

    /** 3D Secure and other transaction security settings. Maps to {@see TransactionSecurity}. */
    public array|object|null $transaction_security;

    private $map = [
        "differential_pricing" => "MercadoPago\Resources\Common\DifferentialPricing",
        "transaction_security" => "MercadoPago\Resources\Order\TransactionSecurity",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
