<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** OnlineConfig class. */
class OnlineConfig
{
    /** Class mapper. */
    use Mapper;

    /** Callback URL. */
    public ?string $callback_url;

    /** Success URL. */
    public ?string $success_url;

    /** Pending URL. */
    public ?string $pending_url;

    /** Failure URL. */
    public ?string $failure_url;

    /** Auto return URL. */
    public ?string $auto_return_url;

    /** Differential pricing. */
    public array|object|null $differential_pricing;

    /** Transaction security. */
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
