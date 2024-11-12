<?php

/** Swagger version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Items class. */
class Items
{
    /** Class mapper. */
    use Mapper;

    /** Title. */
    public ?string $title;

    /** Description. */
    public ?string $description;

    /** Unit price. */
    public ?string $unit_price;

    /** Code. */
    public ?string $code;

    /** Type. */
    public ?string $type;

    /** Picture URL. */
    public ?string $picture_url;

    /** Quantity. */
    public ?int $quantity;

    /** Warranty. */
    public ?bool $warranty;

    /** Category descriptor. */
    public array|object|null $category_descriptor;

    private $map = [
        "category_descriptor" => "MercadoPago\Resources\Order\CategoryDescriptor",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
