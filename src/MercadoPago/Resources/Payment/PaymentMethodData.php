<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents method-specific data within a payment method in the MercadoPago API.
 *
 * Contains references and business rules (discounts, fines, interest) that
 * apply to the selected payment method. Nested within {@see PaymentMethod}.
 */
class PaymentMethodData
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var PaymentMethodRules|array|null Business rules applied to the payment method (discounts, fine, interest). */
    public array|object|null $rules;

    /** Internal reference identifier for the payment method transaction. */
    public ?string $reference_id;

    /** External reference identifier for cross-system reconciliation. */
    public ?string $external_reference_id;

    /** URL to an external resource related to the payment (e.g. boleto PDF, ticket page). */
    public ?string $external_resource_url;

    private $map = [
        "rules" => "MercadoPago\Resources\Payment\PaymentMethodRules",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
