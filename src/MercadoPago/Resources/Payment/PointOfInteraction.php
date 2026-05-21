<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the point of interaction where the payment was initiated in the MercadoPago API.
 *
 * Describes the channel or device through which the payer interacted to make the payment,
 * such as a QR code, deep link, or IVR system. Nested within {@see \MercadoPago\Resources\Payment}.
 */
class PointOfInteraction
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Interaction type (e.g. "OPENPLATFORM", "ATML", "QR"). */
    public ?string $type;

    /** Interaction subtype providing additional classification. */
    public ?string $sub_type;

    /** @var ApplicationData|array|null Application that generated the interaction. */
    public array|object|null $application_data;

    /** @var TransactionData|array|null Transaction data generated at the point of interaction (e.g. QR content, ticket URL). */
    public array|object|null $transaction_data;

    private $map = [
        "application_data" => "MercadoPago\Resources\Payment\ApplicationData",
        "transaction_data" => "MercadoPago\Resources\Payment\TransactionData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
