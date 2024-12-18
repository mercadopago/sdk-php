<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

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

    /** Item ID. */
    public ?string $id;

    /** Category ID. */
    public ?string $category_id;

    /** Description. */
    public ?string $description;

    /** Picture URL. */
    public ?string $picture_url;

    /** Item Type. */
    public ?string $type;
}
