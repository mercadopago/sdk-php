<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a line item within a MercadoPago order.
 *
 * Each item describes a product or service being purchased, including
 * its price, quantity, and categorization. The sum of all item amounts
 * should match the order's total amount.
 *
 * @see \MercadoPago\Resources\Order
 */
class Items
{
    /** Class mapper. */
    use Mapper;

    /** Unique identifier of the item within the order. */
    public ?string $id;

    /** Display name of the product or service. */
    public ?string $title;

    /** Price per unit in the order's currency. */
    public ?string $unit_price;

    /** Number of units of this item being purchased. */
    public ?int $quantity;

    /** Unit of measure for the item (e.g., "unit", "kg"). */
    public ?string $unit_measure;

    /** Seller-defined code to identify the item in an external system (e.g., SKU). */
    public ?string $external_code;

    /** External category classifications for the item. Each element maps to {@see ExternalCategory}. */
    public ?array $external_categories;

    /** MercadoPago category identifier used for fraud analysis and processing rules. */
    public ?string $category_id;

    /** Detailed description of the product or service. */
    public ?string $description;

    /** URL of the item's product image. */
    public ?string $picture_url;

    /** Item type classification (e.g., "physical", "digital", "service"). */
    public ?string $type;

    /** Whether the item includes a warranty. */
    public ?bool $warranty;

    /** ISO 8601 date of the event associated with the item (e.g., for ticket sales). */
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
