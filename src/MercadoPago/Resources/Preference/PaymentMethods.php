<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Serialization\Mapper;

/**
 * Preference Payment Methods configuration resource.
 *
 * Configures which payment methods are available for a checkout preference.
 * Allows setting a default payment method, installment limits, excluded payment
 * methods, excluded payment types, and a default card.
 *
 * Fields are mapped to nested DTOs:
 * - excluded_payment_methods -> {@see \MercadoPago\Resources\Preference\PaymentMethod}
 * - excluded_payment_types -> {@see \MercadoPago\Resources\Preference\PaymentType}
 */
class PaymentMethods
{
    /** Class mapper. */
    use Mapper;

    /** Default payment method ID to pre-select in checkout. */
    public ?string $default_payment_method_id;

    /** Maximum number of installments allowed. */
    public ?int $installments;

    /** Default number of installments pre-selected in checkout. */
    public ?int $default_installments;

    /** Payment methods not allowed in payment process (except account_money). */
    public ?array $excluded_payment_methods;

    /** Payment types not allowed in payment process. */
    public ?array $excluded_payment_types;

    /** Default card ID. */
    public ?string $default_card_id;

    private $map = [
        "excluded_payment_methods" => "MercadoPago\Resources\Preference\PaymentMethod",
        "excluded_payment_types" => "MercadoPago\Resources\Preference\PaymentType",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
