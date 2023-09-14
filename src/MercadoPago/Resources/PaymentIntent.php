<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PaymentIntent class. */
class PaymentIntent extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Additional info of the payment intent.*/
    public array|object|null $additional_info;

    /** Amount of the payment intent.*/
    public ?float $amount;

    /** Description of the payment intent.*/
    public ?string $description;

    /** Device id for the payment intent.*/
    public ?string $device_id;

    /** ID of the payment intent.*/
    public ?string $id;

    /** Payment intent details.*/
    public array|object|null $payment;

    /** Payment intent mode.*/
    public ?string $payment_mode;

    /** State of the payment intent.*/
    public ?string $state;

    public $map = [
        "additional_info" => "MercadoPago\Resources\Point\PaymentIntentAdditionalInfo",
        "payment" => "MercadoPago\Resources\Point\PaymentIntentPayment",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
