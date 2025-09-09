<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Items class. */
class Items
{
    /** Class mapper. */
    use Mapper;

    /** ID. */
    public ?string $id;

    /** Title. */
    public ?string $title;

    /** Unit price. */
    public ?string $unit_price;

    /** Quantity. */
    public ?int $quantity;

    /** Unit measure. */
    public ?string $unit_measure;

    /** External code. */
    public ?string $external_code;

    /** External categories. */
    public ?array $external_categories;

    /** Category ID. */
    public ?string $category_id;

    /** Description. */
    public ?string $description;

    /** Picture URL. */
    public ?string $picture_url;

    /** Type. */
    public ?string $type;

    /** Warranty. */
    public ?bool $warranty;

    /** Event Date */
    public ?string $event_date;

    private $map = [
        "external_categories" => "MercadoPago\Resources\Order\ExternalCategory",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
