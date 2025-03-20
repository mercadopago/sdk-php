<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Payment class. */
class Payment
{
    /** Class mapper. */
    use Mapper;

    /** Payment ID. */
    public ?string $id;

    /** Reference ID. */
    public ?string $reference_id;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Amount. */
    public ?string $amount;

    /** Paid amount. */
    public ?string $paid_amount;

    /** Date of expiration. */
    public ?string $date_of_expiration;

    /** Expiration time. */
    public ?string $expiration_time;

    /** Attempt number. */
    public ?int $attempt_number;

    /** Attempts. */
    public ?array $attempts;

    /** Payment method. */
    public array|object|null $payment_method;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
        "attempts" => "MercadoPago\Resources\Order\Attempt",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
