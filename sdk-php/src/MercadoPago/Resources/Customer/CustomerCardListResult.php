<?php

namespace MercadoPago\Resources\Customer;

use MercadoPago\Serialization\Mapper;

/** CustomerCardListResult class. */
class CustomerCardListResult
{
    /** Class mapper. */
    use Mapper;

    /** Id of the card. */
    public ?string $id;

    /** Id of the customer. */
    public ?string $customer_id;

    /** Month the card expires. */
    public ?int $expiration_month;

    /** Year the card expires. */
    public ?int $expiration_year;

    /** First six digits of the card. */
    public ?string $first_six_digits;

    /** Last four digits of the card. */
    public ?string $last_four_digits;

    /** Data related to the chosen payment method. */
    public array|object|null $payment_method;

    /** Security code of the card. */
    public array|object|null $security_code;

    /** Card issuer. */
    public array|object|null $issuer;

    /** Data related to the holder of the card, usually the customer. */
    public array|object|null  $cardholder;

    /** Creation date of the record. */
    public ?string $date_created;

    /** Date the record was last updated. */
    public ?string $date_last_updated;

    /** Id of the user. */
    public ?string $user_id;

    /** Flag indicating if this is a record from production or test environment. */
    public ?bool $live_mode;

    /** Card number is. */
    public ?string $card_number_id;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Customer\PaymentMethod",
        "security_code" => "MercadoPago\Resources\Customer\SecurityCode",
        "issuer" => "MercadoPago\Resources\Customer\Issuer",
        "cardholder" => "MercadoPago\Resources\Customer\Cardholder",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
