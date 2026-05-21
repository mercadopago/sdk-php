<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Item resource.
 *
 * Represents a product or service line item within a checkout preference.
 * Each item defines what the buyer is purchasing, including its title,
 * description, quantity, unit price, and optional category descriptor.
 *
 * @property array|object|null $category_descriptor Category metadata, mapped to {@see \MercadoPago\Resources\Preference\CategoryDescriptor}.
 */
class Item
{
    /** Item code. */
    public ?string $id;

    /** Item name. */
    public ?string $title;

    /** Long item description. */
    public ?string $description;

    /** Image URL. */
    public ?string $picture_url;

    /** Category of the item. */
    public ?string $category_id;

    /** Item's quantity. */
    public ?int $quantity;

    /** Unit price. */
    public ?float $unit_price;

    /** Currency ID. ISO_4217 code. */
    public ?string $currency_id;

    /** Category Descriptor */
    public array|object|null $category_descriptor;

    public $map = [
        "category_descriptor" => "MercadoPago\Resources\Preference\CategoryDescriptor",
    ];

    public function getMap(): array
    {
        return $this->map;
    }
}
