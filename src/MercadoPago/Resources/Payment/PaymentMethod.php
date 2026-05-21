<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the payment method used for a payment in the MercadoPago API.
 *
 * Provides details about which payment method was selected and any associated
 * method-specific data such as references and rules.
 * Nested within {@see \MercadoPago\Resources\Payment}.
 */
class PaymentMethod
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var PaymentMethodData|array|null Method-specific data including references and rules. */
    public array|object|null $data;

    /** Payment method identifier (e.g. "visa", "pix", "bolbradesco"). */
    public ?string $id;

    /** Payment method type (e.g. "credit_card", "debit_card", "ticket", "bank_transfer"). */
    public ?string $type;

    /** Identifier of the card issuer or financial institution. */
    public ?string $issuer_id;

    private $map = [
        "data" => "MercadoPago\Resources\Payment\PaymentMethodData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
