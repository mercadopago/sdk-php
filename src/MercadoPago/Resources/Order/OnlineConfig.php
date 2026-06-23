<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the online checkout configuration for a MercadoPago order.
 *
 * Controls the buyer's redirect flow after completing checkout, including
 * success/failure/pending URLs, tracking pixels, and additional checkout
 * behavior such as differential pricing and 3DS security.
 *
 * @see \MercadoPago\Resources\Order\Config
 */
class OnlineConfig
{
    /** Class mapper. */
    use Mapper;

    /** ISO 8601 datetime from which the order is available for payment. */
    public ?string $available_from;

    /** Restricts who can pay. "account_only" limits to logged-in MercadoPago users; omit to accept all users. */
    public ?string $allowed_user_type;

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

    /** Controls automatic redirect behavior after payment. "approved" redirects to success_url on approval; "all" redirects on any outcome. */
    public ?string $auto_return;

    /** Tracking pixels fired at checkout completion. Supports "google_ad" and "facebook_ad" types. Each element maps to {@see Track}. */
    public ?array $tracks;

    /** Payment retry configuration for this order. Maps to {@see Retries}. */
    public array|object|null $retries;

    /** Differential pricing configuration for offering different prices per payment method. Maps to DifferentialPricing. */
    public array|object|null $differential_pricing;

    /** 3D Secure and other transaction security settings. Maps to {@see TransactionSecurity}. */
    public array|object|null $transaction_security;

    private $map = [
        "tracks" => "MercadoPago\Resources\Order\Track",
        "retries" => "MercadoPago\Resources\Order\Retries",
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
