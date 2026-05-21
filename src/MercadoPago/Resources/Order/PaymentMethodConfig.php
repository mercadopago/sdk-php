<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents payment method configuration and restrictions for an order.
 *
 * Controls which payment methods are allowed or excluded, sets defaults,
 * and configures installment limits and cost absorption rules.
 *
 * @see \MercadoPago\Resources\Order\Config
 */
class PaymentMethodConfig
{
    /** Class mapper. */
    use Mapper;

    /** List of payment method IDs excluded from the checkout (e.g., ["amex", "visa"]). */
    public ?array $not_allowed_ids;

    /** List of payment method types excluded from the checkout (e.g., ["credit_card"]). */
    public ?array $not_allowed_types;

    /** Default payment method ID pre-selected in the checkout. */
    public ?string $default_id;

    /** Default payment method type pre-selected in the checkout. */
    public ?string $default_type;

    /** Maximum number of installments allowed for the order. */
    public ?int $max_installments;

    /** Default number of installments pre-selected in the checkout. */
    public ?int $default_installments;

    /** Minimum number of installments allowed for the order. */
    public ?int $min_installments;

    /** Who absorbs the installment interest cost (e.g., "seller", "buyer"). */
    public ?string $installments_cost;

    /** Detailed installment configuration including promotions. Maps to {@see Installments}. */
    public array|object|null $installments;

    private $map = [
        "installments" => "MercadoPago\Resources\Order\Installments",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
