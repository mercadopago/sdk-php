<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

/** Items class. */
class Items
{
    /** Title. */
    public ?string $title;

    /** Unit price. */
    public ?string $unit_price;

    /** Quantity. */
    public ?int $quantity;

    /** External code. */
    public ?string $external_code;

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
}
