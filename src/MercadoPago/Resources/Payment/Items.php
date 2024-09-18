<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Items class. */
class Items
{
    /** Class mapper. */
    use Mapper;

    /** It is the ad identifier of the purchased product. For example – “MLB2907679857”.*/
    public ?string $id;

    /** Item name.*/
    public ?string $title;

    /** Description of the article. */
    public ?string $description;

    /** Image URL. */
    public ?string $picture_url;

    /** Item category.*/
    public ?string $category_id;

    /** Quantidade do produto. */
    public ?string $quantity;

    /** Unit price of the item purchased. This parameter will be returned as a String. For Chile (MLC) must be an integer.*/
    public ?float $unit_price;

    /**  Type of item being sold*/
    public ?string $type;

    /** Event Date - Use the ISO 8601 standard format to enter the date and time of the event. The format should be "yyyy-MM-ddTHH:mm:ss.sssZ". For example:"2023-12-31T09:37:52.000-04:00". */
    public ?string $event_date;

    /** Indicates whether the product has a warranty or not. True if it has, false if not. */
    public ?bool $warranty;

    /** Category Descriptor. */
    public array|object|null $category_descriptor;

    private $map = [
        "category_descriptor" => "MercadoPago\Resources\Payment\CategoryDescriptor",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
