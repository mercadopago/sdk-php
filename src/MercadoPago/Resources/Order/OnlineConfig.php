<?php

/** API version: 950ae02-4f49-4686-9ad3-7929b21b6495 */

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

    private $map = [
        "differential_pricing" => "MercadoPago\Resources\Common\DifferentialPricing",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
